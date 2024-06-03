/* 
// J5
// Code is Poetry */

//	Structuring of code inspired by Lightbox v2.01
//	by Lokesh Dhakar - http://www.huddletogether.com
//	09.25.14
//	Structuring of code inspired by Scott Upton (http://www.uptonic.com/)

var crnrstn_xhandler = Class.create();

crnrstn_xhandler.prototype = {
	
	initialize: function() {
		//
		// DOM CHECK
		if (!document.getElementsByTagName){ return; }
		
		//
		// PRELOADER
		this.initLightbox_Preloader();
					
		// DATA CONTAINER DEFINITIONS
		// # STORE NAVIGATION DATA []
		var oNavRootPath = '';
		oNavClass_NAME_ARRAY = [];			//oNavClass_NAME_ARRAY[n+1]=CLASSNAME
		oNavClass_URI_ARRAY = [];			//oNavClass_URI_ARRAY[n+1]=CLASSURI
		oNavMethodCnt_ARRAY = [];			//oNavMethodCnt_ARRAY[CLASSNAME]=CNT OF METHODS
		oNavMethod_NAME_ARRAY = [];			//oNavMethod_NAME_ARRAY[CLASSNAME+'_'+iii]=METHODNAME
		oNavMethod_URI_ARRAY = [];			//oNavMethod_URI_ARRAY[CLASSNAME+'_'+iii]=METHODURI

		//
		// # STORE CONTENT DATA []
		var oContentType = '';
		var oContentName = '';
		var oContentURI = '';
		var oContentDescr = '';
		oContentTechSpec_ARRAY = [];
		var oContentInvokingClass = '';
		var oContentMethodDefine = '';
		oContentParamName_ARRAY = [];
		oContentParamReq_ARRAY = [];
		oContentParamDef_ARRAY = [];
		var oContentReturnedValue = '';
		var oContentVersion = '';
		oContentMethodName_ARRAY = [];
		oContentMethodURI_ARRAY = [];
		oContentExampleNode_ARRAY = [];
		oContentExampleID_ARRAY = [];
		
		//
		// # STORE COMMENT DATA []
		var oUGC_pi = '';
		var oUGC_indexSize = '';
		var oUGC_indexCount = '';
		oCommentUNDisplay_ARRAY = [];
		oCommentExtURI_ARRAY = [];
		oCommentThumbnail_ARRAY = [];
		oCommentThumbnail_W_ARRAY = [];
		oCommentThumbnail_H_ARRAY = [];
		oCommentDateCreated_ARRAY = [];
		oCommentSubject_ARRAY = [];
		oCommentURI_ARRAY = [];
		oCommentCommentID_ARRAY = [];
		oCommentTT_ARRAY = [];
		
		//
		// DETECT DATA ARCH MODE [XML,SOAP]
		if($("content_mode")){
			if($("content_mode").innerHTML=='XML'){
				var query = window.location.href; 
				var vars = query.split("/");
				var cleanURI = query.split("?");
				var cleanURI = cleanURI[0].split("#");
				var HTTP_ROOT = vars[0]+'//'+vars[2]+'/';
				
				if($("IS_ERR_PG")){
					if($("IS_ERR_PG").innerHTML!=""){
						this.closeLightbox_Preloader();
					}
				}else{
				
					if(cleanURI[0].split("/account/").length>1 || cleanURI[0].split("/admin/").length>1){
						this.closeLightbox_Preloader();
					}else{
					
						switch(cleanURI[0]){
							case HTTP_ROOT+"crnrstn/licensing/":
							case HTTP_ROOT+"crnrstn/search/":
							case HTTP_ROOT+"crnrstn/download/":
							case HTTP_ROOT+"crnrstn/account/":
							case HTTP_ROOT+"crnrstn/about/":
							case HTTP_ROOT+"crnrstn/":
							case HTTP_ROOT+"licensing/":
							case HTTP_ROOT+"search/":
							case HTTP_ROOT+"download/":
							case HTTP_ROOT+"donate/":
							case HTTP_ROOT+"account/":
							case HTTP_ROOT+"about/":
							case HTTP_ROOT:
								this.closeLightbox_Preloader();	
							break;
							default:
								//
								// PROCESS CONTENT XML
								this.init_ContentXmlParse(this);
							break;
						}
					}
				}
			}
		}
		
		//
		// DETECT DATA ARCH MODE [XML,SOAP]
		if($("nav_mode")){
			if($("nav_mode").innerHTML=='XML'){
				//
				// PROCESS NAVIGATION XML
				this.init_NavXmlParse(this);
			}
		}
		
		//
		// DETECT DATA ARCH MODE [XML,SOAP]
		if($("comment_mode")){
			if($("comment_mode").innerHTML=='XML'){
				var query = window.location.href; 
				var vars = query.split("/"); 
				var cleanURI = query.split("?");
				var cleanURI = cleanURI[0].split("#");
				var HTTP_ROOT = vars[0]+'//'+vars[2]+'/';
				
				if(cleanURI[0].split("/account/").length>1 || cleanURI[0].split("/admin/").length>1){
					this.closeLightbox_Preloader();
				}else{
				
					switch(cleanURI[0]){
						case HTTP_ROOT+"crnrstn/licensing/":
						case HTTP_ROOT+"crnrstn/search/":
						case HTTP_ROOT+"crnrstn/download/":
						case HTTP_ROOT+"crnrstn/account/":
						case HTTP_ROOT+"crnrstn/about/":
						case HTTP_ROOT+"crnrstn/":
						case HTTP_ROOT+"licensing/":
						case HTTP_ROOT+"search/":
						case HTTP_ROOT+"download/":
						case HTTP_ROOT+"donate/":
						case HTTP_ROOT+"account/":
						case HTTP_ROOT+"about/":
						case HTTP_ROOT:
							this.closeLightbox_Preloader();	
						break;
						default:
							//
							// PROCESS CONTENT XML
							//this.init_ContentXmlParse(this);
							this.init_CommentsXmlParse(this);
								
						break;
					}
				}
			}
		}
	},
	
	init_NavXmlParse: function(){
		//alert("about to get NAV XML. oncomplete....parse.");
		var query = window.location.href; 
		var vars = query.split("/");
		var HTTP_ROOT = vars[0]+'//'+vars[2]+'/';
		var HTTP_ROOT_DIR = $("http_root_dir").innerHTML;
		var uri = HTTP_ROOT + HTTP_ROOT_DIR + 'common/xml/nav/crnrstn_nav.xml';
		//var uri = HTTP_ROOT + 'common/xml/nav/crnrstn_nav.xml';
		var params = "";
		var myAjax_nav = new Ajax.Request(
			uri, 
			{
				method: 'get', 
				parameters: params, 
				onComplete: this.nav_XMLParse
			}); 	
	},
	
	init_ContentXmlParse: function(){
		var query = window.location.href; 
		var vars = query.split("/"); 
		var HTTP_ROOT = vars[0]+'//'+vars[2]+'/';
		var HTTP_ROOT_DIR = $("http_root_dir").innerHTML;
		var contentid = $("contentid").innerHTML;
		//var uri = HTTP_ROOT + 'crnrstn/common/xml/content/crnrstn_'+contentid+'.xml';
		var uri = HTTP_ROOT + HTTP_ROOT_DIR +'common/xml/content/crnrstn_'+contentid+'.xml';
		var params = "";
		var myAjax_nav = new Ajax.Request(
			uri, 
			{
				method: 'get', 
				parameters: params, 
				onComplete: this.content_XMLParse
			}); 	
	},
	
	init_CommentsXmlParse: function(){
		var query = window.location.href; 
		var vars = query.split("/"); 
		var vars_PI = query.split("pi="); 
		var HTTP_ROOT = vars[0]+'//'+vars[2]+'/';
		var HTTP_ROOT_DIR = $("http_root_dir").innerHTML;
		var contentid = $("contentid").innerHTML;
		var pageIndex = vars_PI[1];
		
		if(pageIndex=='' || pageIndex==undefined){
			pageIndex='1';
		}
		//alert("init_CommentsXmlParse for contentid: crnrstn/common/xml/ugcnotes/crnrstn_"+contentid+"_"+pageIndex+".xml");
		//var uri = HTTP_ROOT + 'crnrstn/common/xml/ugcnotes/crnrstn_'+contentid+'_'+pageIndex+'.xml';
		var uri = HTTP_ROOT + HTTP_ROOT_DIR + 'common/xml/ugcnotes/crnrstn_'+contentid+'_'+pageIndex+'.xml';
		var params = "";
		var myAjax_nav = new Ajax.Request(
			uri, 
			{
				method: 'get', 
				parameters: params, 
				onComplete: this.comment_XMLParse
			}); 	
	},
	
	nav_XMLParse: function(originalRequest){
		//
		// PARSE NAVIGATION XML
		var oResponseText = originalRequest.responseText;
		//alert(oResponseText);
		this.oNavRootPath = mycrnrstn_xhandler.responseXML_NodeContent(originalRequest.responseXML.getElementsByTagName("rootpath").item(0),oResponseText,"");
		var oClassesWrapper = originalRequest.responseXML.getElementsByTagName("classes");

		for (var i=0;i<oClassesWrapper.length;i++)
		{
			//alert('XML Nav Container Size :: '+oClassesWrapper.length);
			//var oClassNode = oClassesWrapper.item(i);
			var oClassNode = oClassesWrapper.item(i).getElementsByTagName("class");
			
			//
			// FOR EACH CLASS ALERT() CLASSNAME, CLASSURI, METHODNAME, METHODURI
			for(var ii=0;ii<oClassNode.length;ii++){
				oNavClass_NAME_ARRAY[ii] = mycrnrstn_xhandler.responseXML_NodeContent(oClassNode.item(ii).getElementsByTagName("classname").item(0),oResponseText,"");
				
				//alert('FF test :: '+oClassNode.item(ii).getElementsByTagName("classname").item(0).textContent);

				// 
				// ALERT CLASS NAME
				//alert(oNavClass_NAME_ARRAY[ii]);
				
				//
				// CLASS URI
				oNavClass_URI_ARRAY[ii] = oClassNode.item(ii).getElementsByTagName("classname").item(0).getAttribute("uri");
				//alert('FF test :: '+oClassNode.item(ii).getElementsByTagName("classname").item(0).getAttribute("uri"));
				
				var oMethodsWrapper = oClassNode.item(ii).getElementsByTagName("classmethods");			
				var oMethodNode = oMethodsWrapper.item(0).getElementsByTagName("method");
				oNavMethodCnt_ARRAY[this.oNavClass_NAME_ARRAY[ii]]=0;
				for(var iii=0;iii<oMethodNode.length;iii++){
					
					oNavMethod_NAME_ARRAY[this.oNavClass_NAME_ARRAY[ii]+'_'+iii] = mycrnrstn_xhandler.responseXML_NodeContent(oMethodNode.item(iii),oResponseText,"");

					oNavMethodCnt_ARRAY[this.oNavClass_NAME_ARRAY[ii]] = this.oNavMethodCnt_ARRAY[this.oNavClass_NAME_ARRAY[ii]]+1;
					oNavMethod_URI_ARRAY[this.oNavClass_NAME_ARRAY[ii]+'_'+iii] = oMethodNode.item(iii).getAttribute("uri");
					
					//
					// ALERT METHOD NAME, URI AND COUNT PER CLASS
					//alert(this.oNavMethod_NAME_ARRAY[this.oNavClass_NAME_ARRAY[ii]+'_'+iii]);
					//alert(this.oNavMethod_URI_ARRAY[this.oNavClass_NAME_ARRAY[ii]+'_'+iii]);
					//alert(oNavMethodCnt_ARRAY[this.oNavClass_NAME_ARRAY[ii]]);
					
				}
			}
		}
		
		//
		// LOAD PARSED XML DATA TO PAGE
		mycrnrstn_xhandler.loadXML_Nav(this);
	},
	
	content_XMLParse: function(originalRequest){
		//
		// XML PARSE :: GENERAL CONTENT
		oContentWrapper = originalRequest.responseXML.getElementsByTagName("crnrstn_element");
		var oResponseText = originalRequest.responseText;
		this.oContentType = mycrnrstn_xhandler.responseXML_NodeContent(oContentWrapper.item(0).getElementsByTagName("crnrstn_contenttype").item(0),oResponseText,"");
		this.oContentName = mycrnrstn_xhandler.responseXML_NodeContent(oContentWrapper.item(0).getElementsByTagName("crnrstn_title").item(0),oResponseText,"");
		this.oContentURI = oContentWrapper.item(0).getElementsByTagName("crnrstn_title").item(0).getAttribute("uri");
		this.oContentDescr = mycrnrstn_xhandler.responseXML_NodeContent(oContentWrapper.item(0).getElementsByTagName("crnrstn_description").item(0),oResponseText,"crnrstn_description|0");
		//alert(oContentDescr);

		//
		// XML PARSE :: TECHNICAL SPECIFICATIONS
		var oContentTechSpec = oContentWrapper.item(0).getElementsByTagName("crnrstn_techspecscontent");
		var oTechSpecNode = oContentTechSpec.item(0).getElementsByTagName("crnrstn_techspec");
		for(var i=0;i<oTechSpecNode.length;i++){
			this.oContentTechSpec_ARRAY[i] = mycrnrstn_xhandler.responseXML_NodeContent(oTechSpecNode.item(i),oResponseText,"crnrstn_techspec|"+i);
			//alert(this.oContentTechSpec_ARRAY[i]);
		}
		
		//
		// XML PARSE :: SPLIT CLASS/METHOD PAGE INITIALIZATION 
		switch(this.oContentType){
			case 'm':
				this.oContentInvokingClass = mycrnrstn_xhandler.responseXML_NodeContent(oContentWrapper.item(0).getElementsByTagName("crnrstn_invokingclass").item(0),oResponseText,"");
				this.oContentMethodDefine = mycrnrstn_xhandler.responseXML_NodeContent(oContentWrapper.item(0).getElementsByTagName("crnrstn_methoddefine").item(0),oResponseText,"");
				//alert(this.oContentInvokingClass);
				
				//
				// XML PARSE :: PARAMETERS
				this.oContentParameters = oContentWrapper.item(0).getElementsByTagName("crnrstn_parameterscontent");
				this.oParamNode = this.oContentParameters.item(0).getElementsByTagName("crnrstn_parameter");
				for(var i=0;i<this.oParamNode.length;i++){
					this.oContentParamName_ARRAY[i] = mycrnrstn_xhandler.responseXML_NodeContent(this.oParamNode.item(i).getElementsByTagName("crnrstn_paramname").item(0),oResponseText,"crnrstn_paramname|"+i);
					this.oContentParamReq_ARRAY[i] = mycrnrstn_xhandler.responseXML_NodeContent(this.oParamNode.item(i).getElementsByTagName("crnrstn_paramrequired").item(0),oResponseText,"crnrstn_paramrequired|"+i);
					this.oContentParamDef_ARRAY[i] = mycrnrstn_xhandler.responseXML_NodeContent(this.oParamNode.item(i).getElementsByTagName("crnrstn_paramdefinition").item(0),oResponseText,"crnrstn_paramdefinition|"+i);
					//alert(this.oContentParamDef_ARRAY[i]);
				}
				
				this.oContentReturnedValue = mycrnrstn_xhandler.responseXML_NodeContent(oContentWrapper.item(0).getElementsByTagName("crnrstn_returnedvalue").item(0),oResponseText,"");
				//alert(this.oContentReturnedValue);
			break;
			case 'c':
				this.oContentVersion = mycrnrstn_xhandler.responseXML_NodeContent(oContentWrapper.item(0).getElementsByTagName("crnrstn_version").item(0),oResponseText,"");
				//alert('(193) ' + this.oContentVersion);
				
				//
				// XML PARSE :: CLASS METHODS
				var oContentMethods = oContentWrapper.item(0).getElementsByTagName("crnrstn_classmethodscontent");
				var oClassMethodNode = oContentMethods.item(0).getElementsByTagName("crnrstn_classmethod");
				for(var i=0;i<oClassMethodNode.length;i++){
					this.oContentMethodName_ARRAY[i] = mycrnrstn_xhandler.responseXML_NodeContent(oClassMethodNode.item(i),oResponseText,"");
					this.oContentMethodURI_ARRAY[i] = oClassMethodNode.item(i).getAttribute("uri");
					
					//alert('(201) '+ this.oContentMethodName_ARRAY[i]);
				}
			break;
		}
		
		//
		// XML PARSE :: EXAMPLES
		var oContentExamples = oContentWrapper.item(0).getElementsByTagName("crnrstn_examplescontent");
		var oExampleNode = oContentExamples.item(0).getElementsByTagName("crnrstn_example");
		for(var i=0;i<oExampleNode.length;i++){
			//alert(mycrnrstn_xhandler.responseXML_NodeContent(oExampleNode.item(i),oResponseText,""));
			this.oContentExampleID_ARRAY[i] = mycrnrstn_xhandler.responseXML_NodeContent(oExampleNode.item(i),oResponseText,"");
			this.oContentExampleNode_ARRAY[i] = oExampleNode.item(i).getAttribute("uri");
			//alert('(215) '+this.oContentExampleID_ARRAY[i]);
		}
		
		//
		// LOAD PARSED XML DATA TO PAGE
		mycrnrstn_xhandler.loadXML_Content(this);

	},
	
	comment_XMLParse: function(originalRequest){
		//
		// PARSE COMMENT XML
		var oResponseText = originalRequest.responseText;
		var oUGCCommentsWrapper = originalRequest.responseXML.getElementsByTagName("crnrstn_ugc");
		this.oUGC_pi = mycrnrstn_xhandler.responseXML_NodeContent(oUGCCommentsWrapper.item(0).getElementsByTagName("crnrstn_ugc_pi").item(0),oResponseText,"");
		this.oUGC_indexSize = mycrnrstn_xhandler.responseXML_NodeContent(oUGCCommentsWrapper.item(0).getElementsByTagName("crnrstn_ugc_indexsize").item(0),oResponseText,"");
		this.oUGC_indexCount = mycrnrstn_xhandler.responseXML_NodeContent(oUGCCommentsWrapper.item(0).getElementsByTagName("crnrstn_ugc_indexcount").item(0),oResponseText,"");
		//alert(this.oUGC_indexCount);
		
		//
		// XML PARSE :: COMMENTS
		var oUGCComments = oUGCCommentsWrapper.item(0).getElementsByTagName("crnrstn_ugc_comments");
		var oUGCCommentsNode = oUGCComments.item(0).getElementsByTagName("crnrstn_comment");
		for(var i=0;i<oUGCCommentsNode.length;i++){
			this.oCommentUNDisplay_ARRAY[i] = mycrnrstn_xhandler.responseXML_NodeContent(oUGCCommentsNode.item(i).getElementsByTagName("crnrstn_username_disp").item(0),oResponseText,"");
			this.oCommentExtURI_ARRAY[i] = mycrnrstn_xhandler.responseXML_NodeContent(oUGCCommentsNode.item(i).getElementsByTagName("crnrstn_external_uri").item(0),oResponseText,"crnrstn_external_uri|0");
			this.oCommentThumbnail_ARRAY[i] = mycrnrstn_xhandler.responseXML_NodeContent(oUGCCommentsNode.item(i).getElementsByTagName("crnrstn_usr_thumbnail").item(0),oResponseText,"");
			this.oCommentThumbnail_W_ARRAY[i] = oUGCCommentsNode.item(i).getElementsByTagName("crnrstn_usr_thumbnail").item(0).getAttribute("width");
			this.oCommentThumbnail_H_ARRAY[i] = oUGCCommentsNode.item(i).getElementsByTagName("crnrstn_usr_thumbnail").item(0).getAttribute("height");
			this.oCommentDateCreated_ARRAY[i] = mycrnrstn_xhandler.responseXML_NodeContent(oUGCCommentsNode.item(i).getElementsByTagName("crnrstn_comment_datecreated").item(0),oResponseText,"");
			this.oCommentSubject_ARRAY[i] = mycrnrstn_xhandler.responseXML_NodeContent(oUGCCommentsNode.item(i).getElementsByTagName("crnrstn_comment_subject").item(0),oResponseText,"");
			this.oCommentURI_ARRAY[i] = oUGCCommentsNode.item(i).getElementsByTagName("crnrstn_usr_comment").item(0).getAttribute("uri");
			this.oCommentCommentID_ARRAY[i] = mycrnrstn_xhandler.responseXML_NodeContent(oUGCCommentsNode.item(i).getElementsByTagName("crnrstn_usr_comment").item(0),oResponseText,"");
			//alert(this.oCommentURI_ARRAY[i]);
		}
		
		if(oUGCCommentsNode.length>0){
			//
			// LOAD PARSED XML DATA TO PAGE
			mycrnrstn_xhandler.loadXML_Comment(this);
		}else{
			$("xhandle_ugc_comments").innerHTML = '<p>No user contributed notes are available.</p>';
		}
		
	},
	
	loadXML_Comment: function(xhandle){
		var query = window.location.href; 
		var vars = query.split("/");
		HTTP_ROOT = vars[0]+'//'+vars[2]+'/';
		var HTTP_ROOT_DIR = $("http_root_dir").innerHTML;
		HTTP_ROOT = HTTP_ROOT + HTTP_ROOT_DIR;
		
		
		tmp_str = '';
		//alert(xhandle.oCommentUNDisplay_ARRAY.length);
		for(var comm_i=0;comm_i<xhandle.oCommentUNDisplay_ARRAY.length;comm_i++){
			tmp_str = tmp_str + '<div class="usr_comment">';
			tmp_str = tmp_str + '<table cellpadding="0" cellspacing="0" border="0">';
			tmp_str = tmp_str + '<tr>';
				tmp_str = tmp_str + '<td valign="top" style="width:70px;"><div style="width:66px; height:66px; overflow:hidden; border:2px solid #FFF;"><img src="'+HTTP_ROOT+'common/imgs/usr/thumb/'+xhandle.oCommentThumbnail_ARRAY[comm_i]+'" width="'+xhandle.oCommentThumbnail_W_ARRAY[comm_i]+'" height="'+xhandle.oCommentThumbnail_H_ARRAY[comm_i]+'" alt="'+xhandle.oCommentUNDisplay_ARRAY[comm_i]+'" title="'+xhandle.oCommentUNDisplay_ARRAY[comm_i]+'" style="border:1px solid #FFF;"></div></td>';
				tmp_str = tmp_str + '<td valign="top">';
					tmp_str = tmp_str + '<table cellpadding="0" cellspacing="0" border="0">';
					tmp_str = tmp_str + '<tr>';
						tmp_str = tmp_str + '<td style="padding-left:10px;"><span class="label_un">'+xhandle.oCommentUNDisplay_ARRAY[comm_i]+'</span></td>';
					tmp_str = tmp_str + '</tr>';
					tmp_str = tmp_str + '<tr>';
						tmp_str = tmp_str + '<td style="padding-left:10px;">'+xhandle.oCommentExtURI_ARRAY[comm_i]+'</td>';
					tmp_str = tmp_str + '</tr>';
					tmp_str = tmp_str + '</table>';
				tmp_str = tmp_str + '</td>';
				tmp_str = tmp_str + '<td valign="top">';
					tmp_str = tmp_str + '<div class="comment_datecreated">';
					tmp_str = tmp_str + 'Posted on '+xhandle.oCommentDateCreated_ARRAY[comm_i]+'</div>';
				tmp_str = tmp_str + '</td>';
			tmp_str = tmp_str + '</tr>';
			tmp_str = tmp_str + '<tr>';
				tmp_str = tmp_str + '<td colspan="3" style="line-height:5px;">&nbsp;</td>';
			tmp_str = tmp_str + '</tr>';
			tmp_str = tmp_str + '<tr>';
				tmp_str = tmp_str + '<td colspan="3">';
					tmp_str = tmp_str + '<table cellpadding="0" cellspacing="0" border="0">';
					tmp_str = tmp_str + '<tr>';
					tmp_str = tmp_str + '<td valign="top"><div class="usr_about" style="padding-top:5px;"><strong>Subject:</strong></div></td>';
					tmp_str = tmp_str + '<td><div class="usr_about" style="padding:5px 0 0 10px;">'+xhandle.oCommentSubject_ARRAY[comm_i]+'</div></td>';
					tmp_str = tmp_str + '</tr>';
					tmp_str = tmp_str + '</table>';
				tmp_str = tmp_str + '</td>';
			tmp_str = tmp_str + '</tr>';
			tmp_str = tmp_str + '<tr>';
				tmp_str = tmp_str + '<td colspan="3" style="line-height:5px;">&nbsp;</td>';
			tmp_str = tmp_str + '</tr>';
			tmp_str = tmp_str + '<tr>';
				tmp_str = tmp_str + '<td colspan="3"><div id="xhandle_'+xhandle.oCommentCommentID_ARRAY[comm_i]+'"><div class="xhandle_frm_loading_wrapper"><div class="xhandle_admin_frm_loading_logo"><img src="'+HTTP_ROOT+'common/imgs/logo_tiny_128.gif" width="85" height="47" alt="CRNRSTN ::" title="CRNRSTN ::"></div><div class="xhandle_admin_frm_loading"><img src="'+HTTP_ROOT+'common/imgs/long_loader.gif" width="220" height="19" alt="CRNRSTN :: LOADING..." title="CRNRSTN :: LOADING..."></div></div></div></td>';
			tmp_str = tmp_str + '</tr>';
			tmp_str = tmp_str + '</table>';
			tmp_str = tmp_str + '</div>';
			tmp_str = tmp_str + '<div class="cb_10"></div>';
		}
		
		//alert(tmp_str);
		$("xhandle_ugc_comments").innerHTML = tmp_str;

		//
		// INJECT PAGINATION
		var tmp_pageCnt = 1;
		var tmp_paginationCycle = xhandle.oUGC_indexSize;
		tmp_str = '';
		tmp_str = tmp_str + '<div class="pagination_wrapper">';
			for(pag_i=1;pag_i<((xhandle.oUGC_indexCount*1)+1);pag_i++){

				if(pag_i==xhandle.oUGC_pi){
					tmp_str = tmp_str + '<div class="pi_lnk_active"><div class="pi_copy_wrap">'+tmp_pageCnt+'</div></div>';
					tmp_pageCnt++;
				}else{
					if(query.indexOf("&pi")>1){
						var tmp_uri_array = query.split("&pi=");
					}else{
						var tmp_uri_array = query.split("?pi=");
					}
					
					if(tmp_uri_array[0].split("?").length>1){
						tmp_str = tmp_str + '<div class="pi_lnk" onClick="loadPageFromIndex(\''+tmp_uri_array[0]+'&pi='+tmp_pageCnt+'\'); return false;"><a href="'+tmp_uri_array[0]+'&pi='+tmp_pageCnt+'" target="_self"><div class="pi_copy_wrap">'+tmp_pageCnt+'</a></div></div>';
						
					}else{
						tmp_str = tmp_str + '<div class="pi_lnk" onClick="loadPageFromIndex(\''+tmp_uri_array[0]+'?pi='+tmp_pageCnt+'\'); return false;"><a href="'+tmp_uri_array[0]+'?pi='+tmp_pageCnt+'" target="_self"><div class="pi_copy_wrap">'+tmp_pageCnt+'</a></div></div>';
						
					}
					tmp_pageCnt++;
				}
			}
			
		tmp_str = tmp_str+'</div>';
		
		$("xhandle_pagination").innerHTML = tmp_str;
		
		//
		// INJECT COMMENTS INTO POSITION
		for(var comm_i=0;comm_i<xhandle.oCommentUNDisplay_ARRAY.length;comm_i++){
			var params = '';
			
			//
			// FIRE AJAX TOOL TIP :: WEB SERVICES REQUEST
			var ajax = new Ajax.Updater(
			{success: 'xhandle_'+xhandle.oCommentCommentID_ARRAY[comm_i]},
			xhandle.oCommentURI_ARRAY[comm_i],
			{method: 'get', parameters: params});
			
		}
	
	},
	
	loadXML_Content: function(xhandle){
		//alert('Time to load '+ xhandle.oContentName);
		
		//
		// CLASS & METHOD :: TITLE/DESCRIPTION
		$("content_results_title").innerHTML = xhandle.oContentName;
		if($("element_name")){
			$("element_name").value = xhandle.oContentName;
			$("element_uri").value = xhandle.oContentURI;
		}
		$("xhandle_description").innerHTML = xhandle.oContentDescr;
		delete xhandle.oContentName;
		delete xhandle.oContentDescr;
		
		//
		// CLASS & METHOD :: TECH SPECS
		var tmp_str='<ul>';
		for(var i=0;i<xhandle.oContentTechSpec_ARRAY.length;i++){
			tmp_str = tmp_str + '<li>'+xhandle.oContentTechSpec_ARRAY[i]+'</li>';
		}
		tmp_str = tmp_str+'</ul>';
		$("xhandle_techspecs").innerHTML = tmp_str;
		delete tmp_str;
		delete xhandle.oContentTechSpec_ARRAY;
		
		//
		// METHOD :: INVOKING CLASS
		if($("xhandle_invokingclass")){
			$("xhandle_invokingclass").innerHTML = xhandle.oContentInvokingClass;
			delete xhandle.oContentInvokingClass;
		}
		
		
		//
		// METHOD :: DEFINITION
		if($("xhandle_methoddefine")){
			$("xhandle_methoddefine").innerHTML = xhandle.oContentMethodDefine;
			delete xhandle.oContentMethodDefine;
		}
		
		// 
		// METHOD :: PARAMETER DEFINITIONS
		if($("xhandle_methodparamdefs")){
			var tmp_str='';
			for(var i=0;i<xhandle.oContentParamName_ARRAY.length;i++){
				//
				// INIT CSS
				if(xhandle.oContentParamReq_ARRAY[i]=='0'){
					tmp_reqCSS = 'parameter_require_optional';
					tmp_reqCOPY = '(Optional)';
				}else{
					tmp_reqCSS = 'parameter_require_required';
					tmp_reqCOPY = '(Required)';
				}
				
				tmp_str = tmp_str + '<p><div class="method_parameter">'+xhandle.oContentParamName_ARRAY[i]+'&nbsp;<span class="'+tmp_reqCSS+'">'+tmp_reqCOPY+'</span></div><blockquote class="method_parameter_definition">'+xhandle.oContentParamDef_ARRAY[i]+'</blockquote></p>';
			}
			
			$("xhandle_methodparamdefs").innerHTML = tmp_str;
			delete tmp_str;
			delete oContentParamName_ARRAY;
			delete oContentParamReq_ARRAY;
			delete oContentParamDef_ARRAY;
		}
		
		//
		// METHOD :: RETURNED VALUE
		if($("xhandle_returnedvalue")){
			$("xhandle_returnedvalue").innerHTML = xhandle.oContentReturnedValue;
			delete xhandle.oContentReturnedValue;
		}
		
		//
		// CLASS :: CURRENT VERSION
		if($("xhandle_currentversion")){
			$("xhandle_currentversion").innerHTML = xhandle.oContentVersion;	
			delete xhandle.oContentVersion;
		}
		
		//
		// CLASS & METHOD :: EXAMPLES
		tmp_str = '';
		for(var i=0;i<xhandle.oContentExampleNode_ARRAY.length;i++){
			var uri = xhandle.oContentExampleNode_ARRAY[i];	
			var tmp_exampleID = xhandle.oContentExampleID_ARRAY[i];	
			var tmp_uid = $('uid').innerHTML*1;
			var query = window.location.href;
			var query_encoded = '';
			var query_encoded_ARRAY = query.split("&ns=");
			query_encoded_ARRAY = query_encoded_ARRAY[0].split("/");
			for(var qi=3;qi<query_encoded_ARRAY.length;qi++){
				if(qi==(query_encoded_ARRAY.length-1)){
					query_encoded = query_encoded+query_encoded_ARRAY[qi];
				}else{
					query_encoded = query_encoded+query_encoded_ARRAY[qi] + '/';
				}
			}
			query_encoded = encodeURIComponent(query_encoded);
			var vars = query.split("/"); 
			var HTTP_ROOT = vars[0]+'//'+vars[2]+'/';
			var HTTP_ROOT_DIR = $("http_root_dir").innerHTML;
			HTTP_ROOT = HTTP_ROOT + HTTP_ROOT_DIR;
			var params = '';
			
			if(tmp_uid>399){
				var exampleShell = document.createElement("div");
				exampleShell.setAttribute('id','xhandle_contentexamplesmgmt_'+i);
				if($("xhandle_contentexamples")){
					$("xhandle_contentexamples").appendChild(exampleShell);
					$('xhandle_contentexamplesmgmt_'+i).innerHTML = '<div class="editlnk_editable_section" style="float:right;" onClick="mycrnrstn_fhandler.initAdminForm(\'edit_example\',\'edit_example\',\''+HTTP_ROOT+'admin/mgmt/_frms/examples_edit.php?'+xhandle.oContentType+'='+$("contentid").innerHTML+'&e='+tmp_exampleID+'&uri='+query_encoded+'\'); return false;">edit example</div><div class="cb"></div>';
				}
			}
			
			var exampleShell = document.createElement("div");
			exampleShell.setAttribute('id','xhandle_contentexamples_'+i);
			$("xhandle_contentexamples").appendChild(exampleShell);
			
			//
			// INJECT EXAMPLE HTML INTO NEW CONTAINER
			// FIRE AJAX TOOL TIP :: WEB SERVICES REQUEST
			var ajax = new Ajax.Updater(
			{success: 'xhandle_contentexamples_'+i},
			uri,
			{method: 'get', parameters: params});
			
		}
				
		delete oContentExampleNode_ARRAY;
		
		if($("xhandle_contentmethods")){
			// 
			// CLASS :: METHODS
			tmp_str = '';
			for(var i=0;i<xhandle.oContentMethodName_ARRAY.length;i++){
				tmp_str = tmp_str + '<a href="'+xhandle.oContentMethodURI_ARRAY[i]+'" target="_self">'+xhandle.oContentMethodName_ARRAY[i]+'</a><br/>';		
			}
			
			$("xhandle_contentmethods").innerHTML = tmp_str;
			delete tmp_str;
			delete xhandle.oContentMethodName_ARRAY;
			delete xhandle.oContentMethodURI_ARRAY;
		}
				
		//
		// CLOSE PRELOADER
		this.closeLightbox_Preloader();
		
	},
	
	loadXML_Nav: function(xhandle){
		//xhandle.oNavClass_NAME_ARRAY[i]
		//xhandle.oNavClass_URI_ARRAY[i]
		//xhandle.oNavMethod_NAME_ARRAY[this.oNavClass_NAME_ARRAY[i]+'_'+ii]
		//xhandle.oNavMethod_URI_ARRAY[this.oNavClass_NAME_ARRAY[i]+'_'+ii]
		tmp_str = '';
		tmp_str = tmp_str + '<ul style="border-bottom:1px solid #8E919C;border-left:1px solid #B1B1B1;">';
			for(var i=0;i<xhandle.oNavClass_NAME_ARRAY.length;i++){
			tmp_str = tmp_str +'<li>';
				tmp_str = tmp_str +'<div id="'+xhandle.oNavClass_NAME_ARRAY[i]+'_lnk_copy_wrapper" class="lnk_copy_wrapper" onClick="toggleNavState(\''+xhandle.oNavClass_NAME_ARRAY[i]+'\',\'slide\'); return false;" onMouseOver="lnkMouseOver(\''+xhandle.oNavClass_NAME_ARRAY[i]+'\'); return false;" onMouseOut="lnkMouseOut(\''+xhandle.oNavClass_NAME_ARRAY[i]+'\'); return false;">';
					tmp_str = tmp_str +'<div id="'+xhandle.oNavClass_NAME_ARRAY[i]+'_lnk_activity_overlay" class="lnk_activity_overlay"></div>';
					tmp_str = tmp_str +'<div class="lnk_overlay_acceptor">';
						tmp_str = tmp_str +'<div class="arrow"><img src="'+xhandle.oNavRootPath+'common/imgs/arrow.gif" alt="&gt;" width="13" height="16" class="arrow_compressed"></div>';
						tmp_str = tmp_str +'<div class="lnk_copy">'+xhandle.oNavClass_NAME_ARRAY[i]+'</div>';
						tmp_str = tmp_str +'<div class="cb"></div>';
					tmp_str = tmp_str +'</div>';
				tmp_str = tmp_str +'</div>';
				tmp_str = tmp_str +'<div id="'+xhandle.oNavClass_NAME_ARRAY[i]+'_subnav" class="arrow_subnav" style="display:none;">';
					tmp_str = tmp_str +'<ul>';
						tmp_str = tmp_str +'<li id="'+xhandle.oNavClass_NAME_ARRAY[i]+'_0" class="subnav_class_class" onMouseOver="sublnkMouseOver(this); return false;" onMouseOut="sublnkMouseOut(this); return false;" onclick="loadPage(this,\''+xhandle.oNavClass_URI_ARRAY[i]+'\')"><div class="subnav_lnk_copy"><a href="'+xhandle.oNavClass_URI_ARRAY[i]+'" target="_self" onclick="return false;">'+xhandle.oNavClass_NAME_ARRAY[i]+' ::</a></div></li>';
						
						for(var ii=0;ii<xhandle.oNavMethodCnt_ARRAY[xhandle.oNavClass_NAME_ARRAY[i]];ii++){						
							tmp_str = tmp_str +'<li id="'+xhandle.oNavClass_NAME_ARRAY[i]+'_0'+ii+'" class="subnav_class_method" onMouseOver="sublnkMouseOver(this); return false;" onMouseOut="sublnkMouseOut(this); return false;" onclick="loadPage(this,\''+xhandle.oNavMethod_URI_ARRAY[xhandle.oNavClass_NAME_ARRAY[i]+'_'+ii]+'\')"><div class="subnav_lnk_copy"><a href="'+xhandle.oNavMethod_URI_ARRAY[xhandle.oNavClass_NAME_ARRAY[i]+'_'+ii]+'" target="_self" onclick="return false;">'+xhandle.oNavMethod_NAME_ARRAY[xhandle.oNavClass_NAME_ARRAY[i]+'_'+ii]+'</a></div></li>';
						}
						
					tmp_str = tmp_str +'</ul>';
				tmp_str = tmp_str +'</div>';
			tmp_str = tmp_str +'</li>';
			}
		tmp_str = tmp_str +'</ul>';

		$("nav_lnk_wrapper").innerHTML = tmp_str;
		tmp_str = '';
		//
		// BUILD/INJECT NAV STATE MGMT INTO FOOTER
		for(nav_i=0;nav_i<xhandle.oNavClass_NAME_ARRAY.length;nav_i++){
			tmp_str = tmp_str + xhandle.oNavClass_NAME_ARRAY[nav_i]+'|';
		}
		
		$("ns_opt").innerHTML = tmp_str;
		
		
		initNav();
		delete tmp_str;
		delete xhandle.oNavClass_NAME_ARRAY;
		delete xhandle.oNavClass_URI_ARRAY;
		delete xhandle.oNavMethod_NAME_ARRAY;
		delete xhandle.oNavMethod_URI_ARRAY;
	},
	
	responseXML_NodeContent: function(element,responsetext,node){
		if(element.innerHTML==undefined){
			if(node.length==0){
				return element.textContent;
			}else{
				//
				// PARSE NODE MANUALLY
				var tmp_multiNodeArray = [];
				tmp_multiNodeArray = node.split('|');
				if(tmp_multiNodeArray.length>0){
					//
					// PROCESS MULTI NODE
					var tmp_index = (tmp_multiNodeArray[1]*1)+1;
					var tmp_textArrayRaw = responsetext.split('<'+tmp_multiNodeArray[0]+'>');
					var tmp_textArrayClean = tmp_textArrayRaw[tmp_index].split('</'+tmp_multiNodeArray[0]+'>');

					return tmp_textArrayClean[0];
						
				}else{
					var tmp_textArrayRaw = responsetext.split('<'+node+'>');
					var tmp_textArrayClean = tmp_textArrayRaw[1].split('</'+node+'>');
				
					return tmp_textArrayClean[0];
				}
			}
			
		}else{
			return element.innerHTML;	
		}
		
	},
	
	initLightbox_Preloader: function(){
		$('admin_overlay').style.zIndex = 10;
		$('admin_overlay').style.backgroundColor = '#FFF';
		$('admin_form_shell').style.zIndex = 11;
		$('admin_form_shell').style.backgroundColor = '#FFF';

		var tmp_data = $('admin_frm_loading_shell').innerHTML;
		
		new Effect.Move($('admin_form_shell'), { x: 320, y: 190, duration: 0.0, afterFinish: function(){$('admin_form_shell').innerHTML = $('admin_frm_loading_shell').innerHTML;}});
		
		new Effect.Appear('admin_overlay', { duration: 0.5, from: 0.0, to: 0.7, afterFinish: function(){ 
																									  }});
		
		new Effect.Appear(document.body, { duration: 0.5, from: 0.0, to: 1.0, afterFinish: function(){ 
																									  }});
	},
	
	closeLightbox_Preloader: function(){
		//alert("closing preloader...");
		new Effect.Appear('admin_frm_loading', { duration: 0.5, from: 1.0, to: 0.0, afterFinish: function(){ $('admin_frm_loading').style.zIndex = -1;  }  });
	
		new Effect.Appear('admin_form_shell', { duration: 0.5, from: 1.0, to: 0.0, afterFinish: function(){ 
																									$('admin_form_shell').innerHTML=''; 
																									$('admin_form_shell').style.zIndex = -1; 
																									new Effect.Move($('admin_form_shell'), { x: (320*-1), y: (190*-1), duration: 0.0});
																								}});
		
		new Effect.Appear('admin_overlay', { duration: 0.5, from: 0.5, to: 0.0, afterFinish: function(){ $('admin_overlay').style.zIndex = -1;  }  });

	}
	
}

document.observe("dom:loaded", function() {
									mycrnrstn_xhandler = new crnrstn_xhandler();	
										});
//function initxmlHandler() { mycrnrstn_xhandler = new crnrstn_xhandler(); }
//Event.observe(window, 'load', initxmlHandler, false);
	