(function(c){"function"===typeof define&&define.amd?define(["jquery","./grid.base","./grid.common"],c):"object"===typeof exports?c(require("jquery")):c(jQuery)})(function(c){var m=c.jgrid;c.fn.jqFilter=function(e){if("string"===typeof e){var t=c.fn.jqFilter[e];if(!t)throw"jqFilter - No such method: "+e;var D=c.makeArray(arguments).slice(1);return t.apply(this,D)}var a=c.extend(!0,{filter:null,columns:[],onChange:null,afterRedraw:null,checkValues:null,error:!1,errmsg:"",errorcheck:!0,showQuery:!0,
sopt:null,ops:[],operands:null,numopts:"eq ne lt le gt ge nu nn in ni".split(" "),stropts:"eq ne bw bn ew en cn nc nu nn in ni".split(" "),strarr:["text","string","blob"],groupOps:[{op:"AND",text:"AND"},{op:"OR",text:"OR"}],groupButton:!0,ruleButtons:!0,direction:"ltr"},m.filter,e||{});return this.each(function(){if(!this.filter){this.p=a;if(null===a.filter||void 0===a.filter)a.filter={groupOp:a.groupOps[0].op,rules:[],groups:[]};var e,t=a.columns.length,f,F=/msie/i.test(navigator.userAgent)&&!window.opera,
x=c.isFunction,G=null!=m.defaults&&x(m.defaults.fatalError)?m.defaults.fatalError:alert,v=function(){return c("#"+m.jqID(a.id))[0]||null},r=function(k,a){return c(v()).jqGrid("getGuiStyles",k,a||"")},B=function(k){return c(v()).jqGrid("getGridRes","search."+k)},H=function(c){var a=v(),b=a.p.iColByName[c];if(void 0!==b)return{cm:a.p.colModel[b],iCol:b};b=a.p.iPropByName[c];return void 0!==b?{cm:a.p.colModel[b],iCol:b,isAddProp:!0}:{cm:null,iCol:-1}},E=r("states.error"),D=r("dialog.content");a.initFilter=
c.extend(!0,{},a.filter);if(t){for(e=0;e<t;e++)f=a.columns[e],f.stype?f.inputtype=f.stype:f.inputtype||(f.inputtype="text"),f.sorttype?f.searchtype=f.sorttype:f.searchtype||(f.searchtype="string"),void 0===f.hidden&&(f.hidden=!1),f.label||(f.label=f.name),f.cmName=f.name,f.index&&(f.name=f.index),f.hasOwnProperty("searchoptions")||(f.searchoptions={}),f.hasOwnProperty("searchrules")||(f.searchrules={});a.showQuery&&c(this).append("<table class='queryresult "+D+"' style='display:block;max-width:440px;border:0px none;' dir='"+
a.direction+"'><tbody><tr><td class='query'></td></tr></tbody></table>");var I=function(c,n){var b=[!0,""],g=v();if(x(n.searchrules))b=n.searchrules.call(g,c,n);else if(m&&m.checkValues)try{b=m.checkValues.call(g,c,-1,n.searchrules,n.label)}catch(q){}b&&b.length&&!1===b[0]&&(a.error=!b[0],a.errmsg=b[1])};this.onchange=function(){a.error=!1;a.errmsg="";return x(a.onChange)?a.onChange.call(v(),a,this):!1};this.reDraw=function(){c("table.group:first",this).remove();var k=this.createTableForGroup(a.filter,
null);c(this).append(k);x(a.afterRedraw)&&a.afterRedraw.call(v(),a,this)};this.createTableForGroup=function(k,n){var b=this,g,q=c("<table class='"+r("searchDialog.operationGroup","group")+"' style='border:0px none;'><tbody></tbody></table>"),d="left";"rtl"===a.direction&&(d="right",q.attr("dir","rtl"));null===n&&q.append("<tr class='error' style='display:none;'><th colspan='5' class='"+E+"' align='"+d+"'></th></tr>");var h=c("<tr></tr>");q.append(h);d=c("<th colspan='5' align='"+d+"'></th>");h.append(d);
if(!0===a.ruleButtons){var f=c("<select class='"+r("searchDialog.operationSelect","opsel")+"'></select>");d.append(f);var h="",e;for(g=0;g<a.groupOps.length;g++)e=k.groupOp===b.p.groupOps[g].op?" selected='selected'":"",h+="<option value='"+b.p.groupOps[g].op+"'"+e+">"+b.p.groupOps[g].text+"</option>";f.append(h).bind("change",function(){k.groupOp=c(f).val();b.onchange()})}h="<span></span>";a.groupButton&&(h=c("<input type='button' value='+ {}' title='"+B("addGroupTitle")+"' class='"+r("searchDialog.addGroupButton",
"add-group")+"'/>"),h.bind("click",function(){void 0===k.groups&&(k.groups=[]);k.groups.push({groupOp:a.groupOps[0].op,rules:[],groups:[]});b.reDraw();b.onchange();return!1}));d.append(h);if(!0===a.ruleButtons){var h=c("<input type='button' value='+' title='"+B("addRuleTitle")+"' class='"+r("searchDialog.addRuleButton","add-rule ui-add")+"'/>"),m;h.bind("click",function(){var a,d,h;void 0===k.rules&&(k.rules=[]);for(g=0;g<b.p.columns.length;g++)if(a=void 0===b.p.columns[g].search?!0:b.p.columns[g].search,
d=!0===b.p.columns[g].hidden,(h=!0===b.p.columns[g].searchoptions.searchhidden)&&a||a&&!d){m=b.p.columns[g];break}a=m.searchoptions.sopt?m.searchoptions.sopt:b.p.sopt?b.p.sopt:-1!==c.inArray(m.searchtype,b.p.strarr)?b.p.stropts:b.p.numopts;k.rules.push({field:m.name,op:a[0],data:""});b.reDraw();return!1});d.append(h)}null!==n&&(h=c("<input type='button' value='-' title='"+B("deleteGroupTitle")+"' class='"+r("searchDialog.deleteGroupButton","delete-group")+"'/>"),d.append(h),h.bind("click",function(){for(g=
0;g<n.groups.length;g++)if(n.groups[g]===k){n.groups.splice(g,1);break}b.reDraw();b.onchange();return!1}));if(void 0!==k.groups)for(g=0;g<k.groups.length;g++)d=c("<tr></tr>"),q.append(d),h=c("<td class='first'></td>"),d.append(h),h=c("<td colspan='4'></td>"),h.append(this.createTableForGroup(k.groups[g],k)),d.append(h);void 0===k.groupOp&&(k.groupOp=b.p.groupOps[0].op);if(void 0!==k.rules)for(g=0;g<k.rules.length;g++)q.append(this.createTableRowForRule(k.rules[g],k));return q};this.createTableRowForRule=
function(k,n){var b=this,g=v(),f=c("<tr></tr>"),d,h,e,p="",u;f.append("<td class='first'></td>");var l=c("<td class='columns'></td>");f.append(l);var t=c("<select class='"+r("searchDialog.label","selectLabel")+"'></select>"),y,w=[];l.append(t);t.bind("change",function(){k.field=c(t).val();var a=c(this).parents("tr:first"),d,e;for(e=0;e<b.p.columns.length;e++)if(b.p.columns[e].name===k.field){d=b.p.columns[e];break}if(d){e=c.extend({},d.editoptions||{});delete e.readonly;delete e.disabled;var f=c.extend({},
e||{},d.searchoptions||{},H(d.cmName),{id:m.randId(),name:d.name,mode:"search"});f.column=d;F&&"text"===d.inputtype&&!f.size&&(f.size=10);var n=m.createEl.call(g,d.inputtype,f,"",!0,b.p.ajaxSelectOptions||{},!0);c(n).addClass(r("searchDialog.elem","input-elm"));h=f.sopt?f.sopt:b.p.sopt?b.p.sopt:-1!==c.inArray(d.searchtype,b.p.strarr)?b.p.stropts:b.p.numopts;d="";var q=0,l,p;w=[];c.each(b.p.ops,function(){w.push(this.oper)});b.p.cops&&c.each(b.p.cops,function(b){w.push(b)});for(e=0;e<h.length;e++)p=
h[e],y=c.inArray(h[e],w),-1!==y&&(l=b.p.ops[y],l=void 0!==l?l.text:b.p.cops[p].text,0===q&&(k.op=p),d+="<option value='"+p+"'>"+l+"</option>",q++);c(".selectopts",a).empty().append(d);c(".selectopts",a)[0].selectedIndex=0;m.msie&&9>m.msiever()&&(e=parseInt(c("select.selectopts",a)[0].offsetWidth,10)+1,c(".selectopts",a).width(e),c(".selectopts",a).css("width","auto"));c(".data",a).empty().append(n);m.bindEv.call(g,n,f);c(".input-elm",a).bind("change",function(a){a=a.target;k.data="SPAN"===a.nodeName.toUpperCase()&&
f&&x(f.custom_value)?f.custom_value.call(g,c(a).children(".customelement:first"),"get"):a.value;b.onchange()});setTimeout(function(){k.data=c(n).val();b.onchange()},0)}});var l=0,z,A;for(d=0;d<b.p.columns.length;d++)if(u=void 0===b.p.columns[d].search?!0:b.p.columns[d].search,z=!0===b.p.columns[d].hidden,(A=!0===b.p.columns[d].searchoptions.searchhidden)&&u||u&&!z)u="",k.field===b.p.columns[d].name&&(u=" selected='selected'",l=d),p+="<option value='"+b.p.columns[d].name+"'"+u+">"+b.p.columns[d].label+
"</option>";t.append(p);p=c("<td class='operators'></td>");f.append(p);e=a.columns[l];F&&"text"===e.inputtype&&!e.searchoptions.size&&(e.searchoptions.size=10);l=c.extend({},e.editoptions||{});delete l.readonly;delete l.disabled;l=c.extend({},l,e.searchoptions||{},H(e.cmName),{id:m.randId(),name:e.name});l.column=e;l=m.createEl.call(g,e.inputtype,l,k.data,!0,b.p.ajaxSelectOptions||{},!0);if("nu"===k.op||"nn"===k.op)c(l).attr("readonly","true"),c(l).attr("disabled","true");var C=c("<select class='"+
r("searchDialog.operator","selectopts")+"'></select>");p.append(C);C.bind("change",function(){k.op=c(C).val();var a=c(this).parents("tr:first"),a=c(".input-elm",a)[0];"nu"===k.op||"nn"===k.op?(k.data="","SELECT"!==a.tagName.toUpperCase()&&(a.value=""),a.setAttribute("readonly","true"),a.setAttribute("disabled","true")):("SELECT"===a.tagName.toUpperCase()&&(k.data=a.value),a.removeAttribute("readonly"),a.removeAttribute("disabled"));b.onchange()});h=e.searchoptions.sopt?e.searchoptions.sopt:b.p.sopt?
b.p.sopt:-1!==c.inArray(e.searchtype,b.p.strarr)?b.p.stropts:b.p.numopts;p="";c.each(b.p.ops,function(){w.push(this.oper)});b.p.cops&&c.each(b.p.cops,function(b){w.push(b)});for(d=0;d<h.length;d++)A=h[d],y=c.inArray(h[d],w),-1!==y&&(z=b.p.ops[y],u=k.op===A?" selected='selected'":"",p+="<option value='"+A+"'"+u+">"+(void 0!==z?z.text:b.p.cops[A].text)+"</option>");C.append(p);p=c("<td class='data'></td>");f.append(p);p.append(l);m.bindEv.call(g,l,e.searchoptions);c(l).addClass(r("searchDialog.elem",
"input-elm")).bind("change",function(){k.data="custom"===e.inputtype?e.searchoptions.custom_value.call(g,c(this).children(".customelement:first"),"get"):c(this).val();b.onchange()});p=c("<td></td>");f.append(p);!0===a.ruleButtons&&(l=c("<input type='button' value='-' title='"+B("deleteRuleTitle")+"' class='"+r("searchDialog.deleteRuleButton","delete-rule ui-del")+"'/>"),p.append(l),l.bind("click",function(){for(d=0;d<n.rules.length;d++)if(n.rules[d]===k){n.rules.splice(d,1);break}b.reDraw();b.onchange();
return!1}));return f};this.getStringForGroup=function(a){var c="(",b;if(void 0!==a.groups)for(b=0;b<a.groups.length;b++){1<c.length&&(c+=" "+a.groupOp+" ");try{c+=this.getStringForGroup(a.groups[b])}catch(g){G(g)}}if(void 0!==a.rules)try{for(b=0;b<a.rules.length;b++)1<c.length&&(c+=" "+a.groupOp+" "),c+=this.getStringForRule(a.rules[b])}catch(g){G(g)}c+=")";return"()"===c?"":c};this.getStringForRule=function(e){var f="",b="",g,q,d=e.data,h;for(g=0;g<a.ops.length;g++)if(a.ops[g].oper===e.op){f=a.operands.hasOwnProperty(e.op)?
a.operands[e.op]:"";b=a.ops[g].oper;break}if(""===b&&null!=a.cops)for(h in a.cops)if(a.cops.hasOwnProperty(h)&&(b=h,f=a.cops[h].operand,x(a.cops[h].buildQueryValue)))return a.cops[h].buildQueryValue.call(a,{cmName:e.field,searchValue:d,operand:f});for(g=0;g<a.columns.length;g++)if(a.columns[g].name===e.field){q=a.columns[g];break}if(null==q)return"";if("bw"===b||"bn"===b)d+="%";if("ew"===b||"en"===b)d="%"+d;if("cn"===b||"nc"===b)d="%"+d+"%";if("in"===b||"ni"===b)d=" ("+d+")";a.errorcheck&&I(e.data,
q);return-1!==c.inArray(q.searchtype,["int","integer","float","number","currency"])||"nn"===b||"nu"===b?e.field+" "+f+" "+d:e.field+" "+f+' "'+d+'"'};this.resetFilter=function(){a.filter=c.extend(!0,{},a.initFilter);this.reDraw();this.onchange()};this.hideError=function(){c("th."+E,this).html("");c("tr.error",this).hide()};this.showError=function(){c("th."+E,this).html(a.errmsg);c("tr.error",this).show()};this.toUserFriendlyString=function(){return this.getStringForGroup(a.filter)};this.toString=
function(){function c(b){var a="(",f;if(void 0!==b.groups)for(f=0;f<b.groups.length;f++)1<a.length&&(a="OR"===b.groupOp?a+" || ":a+" && "),a+=c(b.groups[f]);if(void 0!==b.rules)for(f=0;f<b.rules.length;f++){1<a.length&&(a="OR"===b.groupOp?a+" || ":a+" && ");var d=b.rules[f];if(e.p.errorcheck){var h,m=void 0;for(h=0;h<e.p.columns.length;h++)if(e.p.columns[h].name===d.field){m=e.p.columns[h];break}m&&I(d.data,m)}a+=d.op+"(item."+d.field+",'"+d.data+"')"}a+=")";return"()"===a?"":a}var e=this;return c(a.filter)};
this.reDraw();if(a.showQuery)this.onchange();this.filter=!0}}})};c.extend(c.fn.jqFilter,{toSQLString:function(){var c="";this.each(function(){c=this.toUserFriendlyString()});return c},filterData:function(){var c;this.each(function(){c=this.p.filter});return c},getParameter:function(c){return void 0!==c&&this.p.hasOwnProperty(c)?this.p[c]:this.p},resetFilter:function(){return this.each(function(){this.resetFilter()})},addFilter:function(e){"string"===typeof e&&(e=c.parseJSON(e));this.each(function(){this.p.filter=
e;this.reDraw();this.onchange()})}})});
//# sourceMappingURL=grid.filter.map
