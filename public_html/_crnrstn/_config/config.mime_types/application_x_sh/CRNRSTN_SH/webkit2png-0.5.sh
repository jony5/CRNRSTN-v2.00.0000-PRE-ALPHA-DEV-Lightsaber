#!/usr/bin/env python
# -*- coding: utf-8 -*-

# OR:
# coding=utf-8

__version__ = "0.6"

#
# Based on Paul Hammond's webkit2png script - make screenshots of webpages
# http://www.paulhammond.org/webkit2png
#
# Modified by Paulo Avila for the Page Capture widget
#
# The original source code (v0.5) belongs to Paul Hammond (see notice below).
# Any and all code added after is Copyright (c) 2009 Paulo Avila.
#
# Modification Log by Paul Avila
#
#  2009.04.21 - Changed almost all the output messages in order to behave properly with my Page Capture widget
#  2009.04.21 - Added function headers
#  2009.04.21 - Properly flush the output buffers so that messages display immediately
#  2009.04.21 - Changed encoding of this file to UTF-8
#  2009.04.25 - Updated how files are named: "<domain> > <file>.png"
#  2009.04.25 - Files are now named with the full URL excluding protocol (http://) and arguments (...?*)
#



# Copyright (c) 2009 Paul Hammond
#
# Permission is hereby granted, free of charge, to any person obtaining a copy
# of this software and associated documentation files (the "Software"), to deal
# in the Software without restriction, including without limitation the rights
# to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
# copies of the Software, and to permit persons to whom the Software is
# furnished to do so, subject to the following conditions:
#
# The above copyright notice and this permission notice shall be included in
# all copies or substantial portions of the Software.
#
# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
# IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
# FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
# AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
# LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
# OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
# THE SOFTWARE.
#
                
import sys
import optparse

try:
  import Foundation
  import WebKit
  import AppKit
  import objc
except ImportError:
  #print "Cannot find pyobjc library files.  Are you sure it is installed?"
  print "Mac OS X 10.5 or higher is required."
  sys.stdout.flush()
  sys.exit() 



class AppDelegate (Foundation.NSObject):
    # what happens when the app starts up
    def applicationDidFinishLaunching_(self, aNotification):
        webview = aNotification.object().windows()[0].contentView()
        webview.frameLoadDelegate().getURL(webview)

class WebkitLoad (Foundation.NSObject, WebKit.protocols.WebFrameLoadDelegate):
    # what happens if something goes wrong while loading
    def webView_didFailLoadWithError_forFrame_(self,webview,error,frame):
        #print " ... something went wrong" 
        print "Unable to load WebKit."
        sys.stdout.flush()
        self.getURL(webview)
    def webView_didFailProvisionalLoadWithError_forFrame_(self,webview,error,frame):
        #print " ... something went wrong" 
        print "Check URL or Internet connection."
        sys.stdout.flush()
        self.getURL(webview)



#---------------------------------------------------
#7 - Generates the filename.

    def makeFilename(self,URL,options):
       # make the filename
       if options.filename:
         filename = options.filename
       elif options.md5:
         try:
                import md5
         except ImportError:
                print "--md5 requires python md5 library"
                sys.stdout.flush()
                AppKit.NSApplication.sharedApplication().terminate_(None)
         filename = md5.new(URL).hexdigest()
       else:
         import re
#         filename = re.sub('\W','',URL); #\W is the same as [^a-zA-Z0-9_]

#--------
         #remove anything after (and including) a question mark
         URL = re.sub("\?.*$", "", URL);
         #arg = URL.find("?");
         #if arg >= 0:
         #    URL = URL[0:arg];

         #remove the protocol string in the beginning (SSL or not)
         URL = re.sub("^https?://", "", URL);



#-- Page Capture # (start)
         import os
         dir = os.path.abspath(os.path.expanduser(options.dir));

         count = 1;
         while os.access(dir + "/Page Capture " + str(count) + ".png", os.F_OK): 
             count += 1;

         filename = "Page Capture " + str(count);
#-- Page Capture # (end)



#-- Full URL (start)
         #replace forward slashes with colons to allow to forward slashes in the filename (OS X's HFS+ allows for this)
      #   filename = re.sub("/", ":", URL);

         #max filename length permitted is 255. (255 - 4 = 251). (4 is the length of the extenion '.png')
      #   if len(filename) > 251:
      #       filename = filename[0:248] + "...";
#-- Full URL (end)



#-- Domain > File (start)
      #   URL = URL.split("/");

         #isolate just the domain
      #   domain = URL[0];
         #domain = re.sub("/.*$", "", URL);
         #domain = URL[0:URL.find("/")];

         #isolate just the file, if it doesn't exist, make it blank
      #   file = URL[len(URL)-1];
      #   if len(URL) == 1:
      #       file = "";

      #   filename = domain + " > " + file;

         #print "d= '" + domain + "'";
         #print "f= '" + file + "'";
#-- Domain > File (end)
#--------

       if options.datestamp:
         import time
         now = time.strftime("%Y%m%d")
#         now = time.strftime("%Y%m%d%H%M%S")
         filename = now + "-" + filename
#       import os
#       dir = os.path.abspath(os.path.expanduser(options.dir))
#       return os.path.join(dir,filename)
       return filename


#---------------------------------------------------
#8 - Saves the captured image(s) to the right place.

    def saveImages(self,bitmapdata,filename,options):
        # save the fullsize png
        if options.fullsize:
			bitmapdata.representationUsingType_properties_(AppKit.NSPNGFileType,None).writeToFile_atomically_(filename + "-full.png",objc.YES)

        if options.thumb or options.clipped:
            # work out how big the thumbnail is
            width = bitmapdata.pixelsWide()
            height = bitmapdata.pixelsHigh()
            thumbWidth = (width * options.scale)
            thumbHeight = (height * options.scale)

            # make the thumbnails in a scratch image
            scratch = AppKit.NSImage.alloc().initWithSize_(
                    Foundation.NSMakeSize(thumbWidth,thumbHeight))
            scratch.lockFocus()
            AppKit.NSGraphicsContext.currentContext().setImageInterpolation_(
                    AppKit.NSImageInterpolationHigh)
            thumbRect = Foundation.NSMakeRect(0.0, 0.0, thumbWidth, thumbHeight)
            clipRect = Foundation.NSMakeRect(0.0, 
                    thumbHeight-options.clipheight, 
                    options.clipwidth, options.clipheight)
            bitmapdata.drawInRect_(thumbRect)
            thumbOutput = AppKit.NSBitmapImageRep.alloc().initWithFocusedViewRect_(thumbRect)
            clipOutput = AppKit.NSBitmapImageRep.alloc().initWithFocusedViewRect_(clipRect)
            scratch.unlockFocus()
           
            # save the thumbnails as pngs 
            if options.thumb:
                thumbOutput.representationUsingType_properties_(
                        AppKit.NSPNGFileType,None
                    ).writeToFile_atomically_(filename + ".png",objc.YES)
#                thumbOutput.representationUsingType_properties_(
#                        AppKit.NSPNGFileType,None
#                    ).writeToFile_atomically_(filename + "-thumb.png",objc.YES)
            if options.clipped:
                clipOutput.representationUsingType_properties_(
                        AppKit.NSPNGFileType,None
                    ).writeToFile_atomically_(filename + "-clipped.png",objc.YES)



#---------------------------------------------------
#1 - Downloads URL contents.

    def getURL(self,webview):
        if self.urls:
            if self.urls[0] == '-':
                url = sys.stdin.readline().rstrip()
                if not url: AppKit.NSApplication.sharedApplication().terminate_(None)
            else:
                url = self.urls.pop(0)
        else:
            AppKit.NSApplication.sharedApplication().terminate_(None)
        #print "Fetching", url, "..."
        print "Fetching URL..."
        sys.stdout.flush()
        self.resetWebview(webview)
        webview.mainFrame().loadRequest_(Foundation.NSURLRequest.requestWithURL_(Foundation.NSURL.URLWithString_(url)))
        if not webview.mainFrame().provisionalDataSource():
            #print " ... not a proper url?"
            print "Invalid URL."
            sys.stdout.flush()
            self.getURL(webview)



#---------------------------------------------------
#2 - Resets any previous history?

    def resetWebview(self,webview):
        rect = Foundation.NSMakeRect(0,0,self.options.initWidth,self.options.initHeight)
        webview.window().setContentSize_((self.options.initWidth,self.options.initHeight))
        webview.setFrame_(rect)



#---------------------------------------------------
#5 - Resizes the window.

    def resizeWebview(self,view):
        view.window().display()
        view.window().setContentSize_(view.bounds().size)
        view.setFrame_(view.bounds())



#---------------------------------------------------
#6 - Turns current webview content into a bitmap.
    def captureView(self,view):
        view.lockFocus()
        bitmapdata = AppKit.NSBitmapImageRep.alloc()
        bitmapdata.initWithFocusedViewRect_(view.bounds())
        view.unlockFocus()
        return bitmapdata



#---------------------------------------------------
#3 - Called for each "piece" of the page.

    # what happens when the page has finished loading
    def webView_didFinishLoadForFrame_(self,webview,frame):
        # don't care about subframes
        if (frame == webview.mainFrame()):
            Foundation.NSTimer.scheduledTimerWithTimeInterval_target_selector_userInfo_repeats_( self.options.delay, self, self.doGrab, webview, False)



#---------------------------------------------------
#4 - Process the downloaded content (calls 5-8)

    def doGrab(self,timer):
            print "Processing image..."
            sys.stdout.flush()
            webview = timer.userInfo()
            view = webview.mainFrame().frameView().documentView()
            
            self.resizeWebview(view)

            URL = webview.mainFrame().dataSource().initialRequest().URL().absoluteString()
            filename = self.makeFilename(URL, self.options) 

            import os
            full_path = os.path.join(os.path.abspath(os.path.expanduser(self.options.dir)), filename);

            bitmapdata = self.captureView(view)  
            self.saveImages(bitmapdata, full_path, self.options)

            #print " ... done"
# ✓
            print "<filename>" + filename + "</filename> saved to your Desktop."
            sys.stdout.flush()
            self.getURL(webview)


def main():

    # parse the command line
    usage = """%prog [options] [http://example.net/ ...]

examples:
%prog http://google.com/            # screengrab google
%prog -W 1000 -H 1000 http://google.com/ # bigger screengrab of google
%prog -T http://google.com/         # just the thumbnail screengrab
%prog -TF http://google.com/        # just thumbnail and fullsize grab
%prog -o foo http://google.com/     # save images as "foo-thumb.png" etc
%prog -                             # screengrab urls from stdin
%prog -h | less                     # full documentation"""

    cmdparser = optparse.OptionParser(usage,version=("webkit2png "+__version__))
    # TODO: add quiet/verbose options
    cmdparser.add_option("-W", "--width",type="float",default=800.0,
       help="initial (and minimum) width of browser (default: 800)")
    cmdparser.add_option("-H", "--height",type="float",default=600.0,
       help="initial (and minimum) height of browser (default: 600)")
    cmdparser.add_option("--clipwidth",type="float",default=200.0,
       help="width of clipped thumbnail (default: 200)",
       metavar="WIDTH")
    cmdparser.add_option("--clipheight",type="float",default=150.0,
       help="height of clipped thumbnail (default: 150)",
       metavar="HEIGHT")
    cmdparser.add_option("-s", "--scale",type="float",default=0.25,
       help="scale factor for thumbnails (default: 0.25)")
    cmdparser.add_option("-m", "--md5", action="store_true",
       help="use md5 hash for filename (like del.icio.us)")
    cmdparser.add_option("-o", "--filename", type="string",default="",
       metavar="NAME", help="save images as NAME-full.png,NAME-thumb.png etc")
    cmdparser.add_option("-F", "--fullsize", action="store_true",
       help="only create fullsize screenshot")
    cmdparser.add_option("-T", "--thumb", action="store_true",
       help="only create thumbnail sreenshot")
    cmdparser.add_option("-C", "--clipped", action="store_true",
       help="only create clipped thumbnail screenshot")
    cmdparser.add_option("-d", "--datestamp", action="store_true",
       help="include date in filename")
    cmdparser.add_option("-D", "--dir",type="string",default="./",
       help="directory to place images into")
    cmdparser.add_option("--delay",type="float",default=0,
       help="delay between page load finishing and screenshot")
    cmdparser.add_option("--noimages", action="store_true",
       help="don't load images")
    cmdparser.add_option("--debug", action="store_true",
       help=optparse.SUPPRESS_HELP)
    (options, args) = cmdparser.parse_args()
    if len(args) == 0:
        cmdparser.print_usage()
        return
    if options.filename:
        if len(args) != 1 or args[0] == "-":
          print "--filename option requires exactly one url"
          sys.stdout.flush()
          return
    if options.scale == 0:
      cmdparser.error("scale cannot be zero")
    # make sure we're outputing something
    if not (options.fullsize or options.thumb or options.clipped):
      options.fullsize = True
      options.thumb = True
      options.clipped = True
    # work out the initial size of the browser window
    #  (this might need to be larger so clipped image is right size)
    options.initWidth = (options.clipwidth / options.scale)
    options.initHeight = (options.clipheight / options.scale)
    if options.width>options.initWidth:
       options.initWidth = options.width
    if options.height>options.initHeight:
       options.initHeight = options.height

    app = AppKit.NSApplication.sharedApplication()
    
    # create an app delegate
    delegate = AppDelegate.alloc().init()
    AppKit.NSApp().setDelegate_(delegate)

    # create a window
    rect = Foundation.NSMakeRect(0,0,100,100)
    win = AppKit.NSWindow.alloc()
    win.initWithContentRect_styleMask_backing_defer_ (rect, 
            AppKit.NSBorderlessWindowMask, 2, 0)
    if options.debug:
      win.orderFrontRegardless()
    # create a webview object
    webview = WebKit.WebView.alloc()
    webview.initWithFrame_(rect)
    # turn off scrolling so the content is actually x wide and not x-15
    webview.mainFrame().frameView().setAllowsScrolling_(objc.NO)

    webview.setPreferencesIdentifier_('webkit2png')
    webview.preferences().setLoadsImagesAutomatically_(not options.noimages)

    # add the webview to the window
    win.setContentView_(webview)
    
    # create a LoadDelegate
    loaddelegate = WebkitLoad.alloc().init()
    loaddelegate.options = options
    loaddelegate.urls = args
    webview.setFrameLoadDelegate_(loaddelegate)
    
    app.run()    

if __name__ == '__main__' : main()

