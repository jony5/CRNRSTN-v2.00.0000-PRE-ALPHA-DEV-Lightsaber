Imports System
Imports System.IO
Imports System.ComponentModel


Public Class vbFile
    'encapsulates the common read, write, exists and delete methods
    'for text file manipulation

    Private opened As Boolean   'true if file is open
    Private end_file As Boolean 'true if at end of file
    Private errDesc As String   'text of last error message
    Private File_name As String 'name of file
    Private fl As File
    Private ts As StreamReader
    Private tok As StringTokenizer
    Private tokLine As String
    Private fs As FileStream
    Private sw As StreamWriter
    Private errFlag As Boolean
    Private lineLength As Integer
    Private sep As String           'tokenizer separator
    '-----
    Public Sub New(ByVal filename As String)
        'Create new file instance 
        file_name = filename     'save file name
        'fl = New File(file_name) 'get file object
        tokLine = ""             'initialize tokenizer
        sep = ","                'and separator
    End Sub
    '----------------
    Public Overloads Function OpenForRead() As Boolean
        Return OpenForRead(file_name)
    End Function
    '----------------
    Public Overloads Function OpenForRead(ByVal Filename As String) As Boolean
        'opens specified file
        file_name = Filename    'save file name
        errFlag = False         'clear errors
        end_File = False        'and end of file
        Try
            ts = fl.OpenText(File_name)    'open the file
        Catch e As Exception
            errDesc = e.Message   'save error message
            errFlag = True        'and flag
        End Try
        Return Not errFlag   'false if error
    End Function

    Public Function readLine() As String
        'Read one line from the file
        Dim s As String
        Try
            s = ts.readLine        'read line from file
            lineLength = s.length  'use to catch null exception
        Catch e As Exception
            end_file = True        'set EOF flag if null
            s = ""                 'and return zero length string
        End Try
        Return s
    End Function

    'example of alternate appraoch to detecting end of file
    Public Function readLineE() As String
        'Read one line from the file
        Dim s As String
        If ts.peek >= 0 Then   'look ahead
            s = ts.readLine       'read if more chars
            Return s
        Else
            end_file = True       'Ser EOF flag if none left
            Return ""
        End If
    End Function

    Public Function readToken() As String
        If (tokLine = "") Then
            tokLine = ts.readLine
        End If
        tok = New StringTokenizer(tokLine, sep)
        tokLine = tok.nextToken
        readToken = tokLine
    End Function

    Public Sub closeFile()
        Try
            ts.close()
        Catch e As Exception
        End Try

        Try
            sw.close()
        Catch e As Exception
        End Try


    End Sub

    Public Function exists() As Boolean
        exists = File.Exists(File_name)
    End Function

    Public Function getLastError() As String
        getlastError = errDesc
    End Function

    Public Overloads Function OpenForWrite(ByVal fname As String) As Boolean
        errFlag = False
        Try
            file_name = fname
            'fl = New File(file_name)    'create File object
            sw = File.CreateText(File_name)          'get StreamWriter
        Catch e As Exception
            errDesc = e.Message
            errflag = True
        End Try
        openForWrite = Not errFlag
    End Function
    '-------------
    Public Overloads Function OpenForWrite() As Boolean
        OpenForWrite = OpenForWrite(file_name)
    End Function
    '-------------
    Public Sub writeText(ByVal s As String)
        sw.writeLine(s)              'write text to stream
    End Sub

    Public Sub setFilename(ByVal fname As String)
        file_name = fname
    End Sub

    Public Function getFilename() As String
        getFilename = file_name
    End Function

    Public Function fEOF() As Boolean
        fEOF = end_file
    End Function

End Class


