(function(){tinymce.create("tinymce.plugins.ContextlyPluginLink",{"static":{selected_text:null,editor:null,select_text_message:"First highlight the word or phrase you want to link, then press this button.",setSelectedText:function(e){this.selected_text=e},getSelectedText:function(){return this.selected_text},setEditor:function(e){this.editor=e},getEditor:function(){return this.editor}},init:function(e,t){var n=!0;e.addCommand("WP_Contextly_Link",function(){if(n){alert(tinymce.plugins.ContextlyPluginLink.select_text_message);return}Contextly.PopupHelper.getInstance().linkPopup()});e.addButton("contextlylink",{title:e.getLang("advanced.link_desc"),image:t+"/img/contextly-link.png",cmd:"WP_Contextly_Link"});e.onNodeChange.add(function(e,t,r,i){n=i&&r.nodeName!="A";var s=e.selection.getContent({format:"text"});tinymce.plugins.ContextlyPluginLink.setSelectedText(s);tinymce.plugins.ContextlyPluginLink.setEditor(e)})},insertLink:function(e,t){var n=tinymce.plugins.ContextlyPluginLink.getEditor(),r={href:e,title:t},i;i=n.dom.getParent(n.selection.getNode(),"A");if(!r.href||r.href=="http://")return;if(i==null){n.getDoc().execCommand("unlink",!1,null);n.getDoc().execCommand("CreateLink",!1,"#mce_temp_url#",{skip_undo:1});tinymce.each(n.dom.select("a"),function(e){if(n.dom.getAttrib(e,"href")=="#mce_temp_url#"){i=e;n.dom.setAttribs(i,r)}});if(jQuery(i).text()=="#mce_temp_url#"){n.dom.remove(i);i=null}}else n.dom.setAttribs(i,r);if(i&&(i.childNodes.length!=1||i.firstChild.nodeName!="IMG")){n.focus();n.selection.select(i);n.selection.collapse(0)}},getInfo:function(){return{longname:"Contextly Link Dialog",author:"Contextly",authorurl:"http://contextly.com",infourl:"",version:"1.0"}}});tinymce.PluginManager.add("contextlylink",tinymce.plugins.ContextlyPluginLink)})();