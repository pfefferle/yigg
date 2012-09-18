NinjaCommander=Class.create({initialize:function(){this.startForms();this.startEditors();this.startUpdaters();this.startActions()},startEditors:function(){var i=$$('.tinymce');if(i.size()>0){if(typeof tinyMCE!='object'){window.findAndLoadMce=function(){tinyMCE.settings={theme:'advanced',theme_advanced_buttons1:'bold,strikethrough,blockquote,|,link,unlink',theme_advanced_buttons2:"",theme_advanced_buttons3:"",theme_advanced_toolbar_location:'top',theme_advanced_toolbar_align:'left',valid_elements:'a[href],strong/b,strong,ol,ul,li,blockquote[cite],p,br',paste_auto_cleanup_on_paste:true,paste_remove_spans:true,paste_remove_styles:true,verify_html:true,gecko_spellcheck:true,debug:true,plugins:'paste',setup:function(h){if(true===$(h.editorId).hasClassName("count")||$(h.editorId).hasClassName("count-comment")){h.onKeyUp.add(function(a,e){var b=(tinyMCE.activeEditor.getContent()).replace(/(<([^>]+)>)/ig,"").length;var c=b+" Zeichen";var d=$('wordCount_'+a.id);if(!d){var f=$(tinyMCE.activeEditor.id+'_parent').down('.mceToolbar');d=$(new Element('span',{'id':'wordCount_'+a.id,'style':'font-size:12px;float:right; padding:5px 15px;'}));f.insert({top:d})}d.update(c);var g=$(a.editorId).hasClassName("count")?550:4000;d.setStyle(b>=g?' color:red;':'color:green;')})}h.onInit.add(function(a,e){tinyMCE.editors[a.id].load()})}};$$('.tinymce').each(function(a){a.identify();if(undefined===tinyMCE.get(a.id)){tinyMCE.execCommand('mceAddControl',true,a.id)}if(-1!==$A(tinyMCE.editors).indexOf(a.id)){tinyMCE.editors[a.id].load()}})};$$('head')[0].insert(new Element('script',{'src':"js/tiny_mce/tiny_mce.js?ver=1"}));return}window.findAndLoadMce();return}document.observe('lightview:loaded',function(){NinjaCommander.initalize()})},startActions:function(){$$('a.ninjaAction').each(function(a){if(!a.id){a.identify()}if(a.ninjaAction){return}a.ninjaAction=NinjaAction;a.observe("click",function(e){this.ninjaAction.executeAction(e);Event.stop(e)}.bind(a))})},startForms:function(){$$('form.ninjaForm').each(function(a){if(a.id&&typeof a.ninjaValidator!='object'){a.ninjaValidator=NinjaValidator;a.ninjaValidator.formName=a.id;token=$(a.id+'__csrf_token');if(token){a.ninjaValidator.csrfToken=$F(token)}a.requiredElements=$$("#"+a.id+' .ninjaRequired');if(a.requiredElements){a.requiredElements.invoke("observe","blur",function(e){this.ninjaValidator.requiredCheck(e)}.bind(a))}a.validationElements=$$("#"+a.id+' .ninjaValidate');if(a.validationElements){a.validationElements.invoke("observe","blur",function(e){this.ninjaValidator.validateField(e)}.bind(a))}a.observe("submit",function(e){if(typeof tinyMCE==="object"){tinyMCE.triggerSave()}this.ninjaValidator.preSubmitCheck(e)}.bind(a))}a.enable()})},startUpdaters:function(){$$(".ninjaUpdater").each(function(a){if(!a.ninjaUpdater){a.ninjaUpdater=new NinjaUpdater(a)}})}});NinjaComs=Class.create({debug:0,request:function(a,b,c,d,e,f){var g=b;if(!f){g=window.location.toString();if(g.indexOf("?")>0){var h=g.substring(g.indexOf("?"),g.length);g=g.substring(0,g.indexOf("?"));g=g.substring(g.length-1,g.length)=="/"?g+b:g+'/'+b+h}else{g=g.substring(g.length-1,g.length)=="/"?g+b:g+'/'+b}}var i=new Ajax.Request(g,{parameters:c,onComplete:e,onSuccess:this.handleResponse.bind(this),onFailure:this.handleResponse.bind(this),evalJS:false,sanitizeJSON:true,requestHeaders:{"Content-Token":a}})},updater:function(a,b,c,d,e,f){if(!e){e='post'}var g=new Ajax.Updater(c,b,{parameters:d,onComplete:f,method:e,sanitizeJSON:true,requestHeaders:{"Content-Token":a}})},handleResponse:function(e,f){if(304==e.status){return}else if(200==e.status){try{if(f){f.each(function(a){var b=a.className;var c=a.action;if(false===Object.isUndefined(b)){var d=eval(b+"."+c);if(true===Object.isFunction(d)){d(a)}}})}}catch(exception){}}else{this.throwComsError("Server Response Error: "+e.statusText+" Server Response incorrect",true);}},throwComsError:function(a,b){}});NinjaValidator=({requiredText:' wird benötigt.',img_dir:(window.parent.document.location.host.match(/yigg\.de$/)?window.parent.document.location.protocol+'//'+'static.yigg.de/v6/':'')+'images/',validating_img:'ajaxindicator.gif',errors:0,target:null,requiredCheck:function(a){if(a.type=="blur"){a=Event.element(a)}var b=a.parentNode;this.resetFieldHolder(b);if($F(a)){this.addValidatedSpan(a,b);return true}else{this.addMessageSpan(a,b);return false}},validateField:function(a){if(a.type=="blur"){a=Event.element(a)}var b=a.parentNode;this.resetFieldHolder(b);var c=$F(a);var d=a.hasClassName("optional");if(c&&!this.isSubmitting){this.addValidatingMsg(b);var e={};e[a.id]=c;if(!this.ninjaComs){this.ninjaComs=new NinjaComs()}this.ninjaComs.request(this.csrfToken,"check"+a.id.capitalize(),e)}else if(d||(c&&this.isSubmitting)){a.removeClassName("validated");a.removeClassName("error")}else{this.addMessageSpan(a,b);return false}},preSubmitCheck:function(e){this.isSubmitting=true;this.errors=0;var c=Event.element(e);this.target=false;if(false===this.doFormValidationCheck(c)){Event.stop(e);return}if(true===c.hasClassName('ninjaAjaxSubmit')){var d=$(c).serialize(true);c.disable();if(!this.ninjaComs){this.ninjaComs=new NinjaComs()}$w($(c).className).each(function(a){if(!a.startsWith('ninja')&&$(a)){this.target=$(a)}}.bind(this));var f=new Ajax.Updater(this.target?this.target:$(c),$(c).action,{parameters:d,onComplete:function(a){NinjaCommander.initialize()},onFailure:function(a){var b=a.responseText;$(c).replace(b);NinjaCommander.initialize()}.bind(c),method:'post',sanitizeJSON:true,requestHeaders:{"Content-Token":this.csrfToken}});Event.stop(e)}else{this.isSubmitting=false}},doFormValidationCheck:function(c){c.requiredElements.each(function(a){var b=this.requiredCheck(a);if(!b){if(a.hasClassName("error")){this.errors++;Effect.Shake(a)}}}.bind(this));return this.errors===0?true:false},addValidatedSpan:function(a,b){a.removeClassName("error");a.addClassName("validated");this.resetFieldHolder(b);var c=new Element('span',{'class':'validated_message'});b.removeClassName('field_error');b.addClassName('field_validated');b.appendChild(c)},addValidatingMsg:function(a){this.resetFieldHolder(a);var b=new Element("img",{'src':this.img_dir+this.validating_img,'alt':"Überprüfung läuft.",'class':'validating'});a.appendChild(b)},addMessageSpan:function(a,b,c){if(!c){c=NinjaValidator.unCamelize(a.id).capitalize()+this.requiredText}a.removeClassName("validated");a.addClassName("error");this.resetFieldHolder(b);var d=new Element('span',{'class':'error_message','id':'error_for_'+a.id});d.update(c);b.removeClassName('field_validated');b.addClassName('field_error');b.appendChild(d)},resetFieldHolder:function(a){var b=$(a).getElementsBySelector('.error_message','.validated_message','.validating').invoke("remove")},updateForm:function(a){var b=$(a.elementId);if(true===Object.isElement(b)){if(a.type=="error"){NinjaValidator.addMessageSpan(b,b.parentNode,a.error)}else{NinjaValidator.addValidatedSpan(b,b.parentNode)}}else if(a){NinjaValidator.throwError("An Error was returned: "+a.error+", but there was no element found");}},unCamelize:function(b){return b.replace(/[a-zA-Z][A-Z0-9]|[0-9][a-zA-Z]/g,function(a){return a.charAt(0)+' '+a.charAt(1)})}});NinjaUpdater=Class.create({type:'',action:'',callback:'',element:'',target:'',in_process:false,current_event:'',script_dir:(window.parent.document.location.host.match(/www\.yigg\.de$/)?window.parent.document.location.protocol+'//'+'static.yigg.de/v6/':'')+'js/',script_suffix:'.js',script_prefix:'ninjaCallback',script_replace:'ninjaCallback',initialize:function(a){a.identify();this.element=a;this.initializeTarget();this.initializeAction();this.coms=new NinjaComs()},initializeTarget:function(){$w(this.element.className).each(function(a){if(a.startsWith('ninjaCallback')){var b=new Element('script',{'id':'script_'+a,'type':'text/javascript','src':this.script_dir+a.replace('ninjaCallback',this.script_prefix)+this.script_suffix});a=a.replace(this.script_replace,'');document.observe(a+":loaded",function(e){this.callback=e.memo.updater}.bind(this));Element.insert($A(document.getElementsByTagName('script')).last(),{'after':b})}if(a.startsWith('ninja')){return}if($(a)){this.target=$(a)}}.bind(this));if(!this.target){this.target=this.element}},initializeAction:function(){if(this.element.hasAttribute('href')){this.type='LINK';this.action=this.element.href;this.element.href='javascript:void(0);';this.initializeObserver('click','GET');return}if(!this.element.hasAttribute('action')){return}if(this.element.hasClassName('ninjaFilter')){this.type='FILTER';observer='change'}else{this.type='FORM';observer='submit'}this.action=this.element.action;this.initializeObserver(observer,'POST')},initializeObserver:function(b,c){Event.observe(this.element,b,function(e){this.current_event=e;Event.stop(e);if(this.element.hasClassName('ninjaConfirm')){if(false===confirm('Sicher?')){return}}var a=(c=='POST')?this.element.serialize(true):'';return this.executeEvent(c,a)}.bind(this))},executeEvent:function(a,b,c){if(true===this.in_process){return}if(this.callback&&Object.isFunction(this.callback.executeUpdate)){this.callback.executeUpdate(this);return}if(false===this.preUpdate()){return}this.target.hide();this.coms.updater(this.element.id,this.action,this.target,b,a,function(){this.target.show();this.postUpdate();this.target.appear({duration:3.0})}.bind(this))},preUpdate:function(){if(this.element.ninjaValidator){if(false===this.element.ninjaValidator.doFormValidationCheck(this.element)){return false}}if(this.callback&&Object.isFunction(this.callback.preUpdate)&&false===this.callback.preUpdate(this)){return false}this.in_process=true;if(this.element.hasClassName('ninjaPreloader')){this.target.update('loading')}if(this.type=='FILTER'){this.element.disable()}},postUpdate:function(){if(this.callback&&Object.isFunction(this.callback.postUpdate)){this.callback.postUpdate(this)}this.in_process=false;if(this.type=='FILTER'){this.element.enable()}NinjaCommander.initialize()}});NinjaUpdater=Class.create({type:'',action:'',callback:'',element:'',target:'',in_process:false,current_event:'',script_dir:(window.parent.document.location.host.match(/www\.yigg\.de$/)?window.parent.document.location.protocol+'//'+'static.yigg.de/v6/':'')+'js/',script_suffix:'.js',script_prefix:'ninjaCallback',script_replace:'ninjaCallback',initialize:function(a){a.identify();this.element=a;this.initializeTarget();this.initializeAction();this.coms=new NinjaComs()},initializeTarget:function(){$w(this.element.className).each(function(a){if(a.startsWith('ninjaCallback')){var b=new Element('script',{'id':'script_'+a,'type':'text/javascript','src':this.script_dir+a.replace('ninjaCallback',this.script_prefix)+this.script_suffix});a=a.replace(this.script_replace,'');document.observe(a+":loaded",function(e){this.callback=e.memo.updater}.bind(this));Element.insert($A(document.getElementsByTagName('script')).last(),{'after':b})}if(a.startsWith('ninja')){return}if($(a)){this.target=$(a)}}.bind(this));if(!this.target){this.target=this.element}},initializeAction:function(){if(this.element.hasAttribute('href')){this.type='LINK';this.action=this.element.href;this.element.href='javascript:void(0);';this.initializeObserver('click','GET');return}if(!this.element.hasAttribute('action')){return}if(this.element.hasClassName('ninjaFilter')){this.type='FILTER';observer='change'}else{this.type='FORM';observer='submit'}this.action=this.element.action;this.initializeObserver(observer,'POST')},initializeObserver:function(b,c){Event.observe(this.element,b,function(e){this.current_event=e;Event.stop(e);if(this.element.hasClassName('ninjaConfirm')){if(false===confirm('Sicher?')){return}}var a=(c=='POST')?this.element.serialize(true):'';return this.executeEvent(c,a)}.bind(this))},executeEvent:function(a,b,c){if(true===this.in_process){return}if(this.callback&&Object.isFunction(this.callback.executeUpdate)){this.callback.executeUpdate(this);return}if(false===this.preUpdate()){return}this.coms.updater(this.element.id,this.action,this.target,b,a,function(){this.target.show();this.postUpdate()}.bind(this))},preUpdate:function(){if(this.element.ninjaValidator){if(false===this.element.ninjaValidator.doFormValidationCheck(this.element)){return false}}if(this.callback&&Object.isFunction(this.callback.preUpdate)&&false===this.callback.preUpdate(this)){return false}this.in_process=true;if(this.element.hasClassName('ninjaPreloader')){this.target.update('loading')}if(this.type=='FILTER'){this.element.disable()}},postUpdate:function(){if(this.callback&&Object.isFunction(this.callback.postUpdate)){this.callback.postUpdate(this)}this.in_process=false;if(this.type=='FILTER'){this.element.enable()}NinjaCommander.initialize()}});NinjaAction=({executeAction:function(e){el=Event.element(e);var a=NinjaValidator.unCamelize(el.id);a=a.replace(" ","/");if(!this.ninjaComs){this.ninjaComs=new NinjaComs()}this.ninjaComs.request(a,a,{'elementId':el.id})},redirect:function(a,b){console.log('redirecting to '+el.href);console.log('this really should get javascript back to know what to do ;)')},updateField:function(a){var b=$(a.elementId);if(true===Object.isElement(b)){b.enable();b.value=a.value}else if(a){NinjaValidator.throwError("An Error was returned: "+a.error+", but there was no element found");}},disableField:function(a){var b=$(a.elementId);if(true===Object.isElement(b)){b.disable()}else if(a){NinjaValidator.throwError("An Error was returned: "+a.error+", but there was no element found");}},replaceContent:function(a){var b=$(a.elementId);if(true===Object.isElement(b)){/*b.enable();*/b.update(a.content)}else if(a){NinjaValidator.throwError("An Error was returned: "+a.error+", but there was no element found");}},removeElement:function(a){var b=$(a.elementId);if(true===Object.isElement(b)){Element.remove(b)}else if(a){NinjaValidator.throwError("An Error was returned: "+a.error+", but there was no element found");}}});Event.observe(window,'load',function(){NinjaCommander=new NinjaCommander()});


$$('a[rel="external"]').each(function(link){
    if(link.readAttribute('href') != '' && link.readAttribute('href') != '#'){
        link.writeAttribute('target','_blank');
    }
});