!function i(a,n,l){function s(t,e){if(!n[t]){if(!a[t]){var r="function"==typeof require&&require;if(!e&&r)return r(t,!0);if(o)return o(t,!0);throw(r=new Error("Cannot find module '"+t+"'")).code="MODULE_NOT_FOUND",r}r=n[t]={exports:{}},a[t][0].call(r.exports,function(e){return s(a[t][1][e]||e)},r,r.exports,i,a,n,l)}return n[t].exports}for(var o="function"==typeof require&&require,e=0;e<l.length;e++)s(l[e]);return s}({1:[function(e,t,r){"use strict";jQuery(function(l){l("ul.misha_gallery_mtb").sortable({items:"li",cursor:"-webkit-grabbing",scrollSensitivity:40,stop:function(e,t){t.item.removeAttr("style");var r=new Array,t=l(this);t.find("li").each(function(e){r.push(l(this).attr("data-id"))}),t.parent().next().val(r.join())}}),l(".misha_upload_gallery_button").click(function(e){e.preventDefault();var i=l(this).prev(),a=i.val().split(","),n=wp.media({title:"Insert images",library:{type:"image"},button:{text:"Use these images"},multiple:!0}).on("select",function(){for(var e=n.state().get("selection").map(function(e){return e.toJSON(),e}),t=!1,r=0;r<e.length;++r)!function(e,t){for(var r in t)if(t[r]==e)return 1}(e[r].id,a)?(l("ul.misha_gallery_mtb").append('<li data-id="'+e[r].id+'"><span style="background-image:url('+e[r].attributes.url+')"></span><a href="#" class="misha_gallery_remove">&times;</a></li>'),a.push(e[r].id)):t=!0;l("ul.misha_gallery_mtb").sortable("refresh"),i.val(a.join()),1==t&&alert("The same images are not allowed.")}).open()}),l("body").on("click",".misha_gallery_remove",function(){var e=l(this).parent().attr("data-id"),t=l(this).parent().parent(),r=t.parent().next(),i=r.val().split(","),e=i.indexOf(e);return l(this).parent().remove(),-1!=e&&i.splice(e,1),r.val(i.join()),t.sortable("refresh"),!1}),l("body").on("mousedown","ul.misha_gallery_mtb li",function(){var e=l(this);e.parent().find("li").removeClass("misha-active"),e.addClass("misha-active")})})},{}]},{},[1]);
//# sourceMappingURL=multi-uploader.js.map