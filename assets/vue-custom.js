!function i(u,a,o){function l(e,t){if(!a[e]){if(!u[e]){var n="function"==typeof require&&require;if(!t&&n)return n(e,!0);if(r)return r(e,!0);throw(n=new Error("Cannot find module '"+e+"'")).code="MODULE_NOT_FOUND",n}n=a[e]={exports:{}},u[e][0].call(n.exports,function(t){return l(u[e][1][t]||t)},n,n.exports,i,u,a,o)}return a[e].exports}for(var r="function"==typeof require&&require,t=0;t<o.length;t++)l(o[t]);return l}({1:[function(t,e,n){"use strict";function c(t){return(c="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function b(t,e){return function(t){if(Array.isArray(t))return t}(t)||function(t,e){var n=null==t?null:"undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(null!=n){var i,u,a=[],o=!0,l=!1;try{for(n=n.call(t);!(o=(i=n.next()).done)&&(a.push(i.value),!e||a.length!==e);o=!0);}catch(t){l=!0,u=t}finally{try{o||null==n.return||n.return()}finally{if(l)throw u}}return a}}(t,e)||function(t,e){if(t){if("string"==typeof t)return i(t,e);var n=Object.prototype.toString.call(t).slice(8,-1);return"Map"===(n="Object"===n&&t.constructor?t.constructor.name:n)||"Set"===n?Array.from(t):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?i(t,e):void 0}}(t,e)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function i(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,i=new Array(e);n<e;n++)i[n]=t[n];return i}Vue.component("mx_input-text",{props:{type:{type:String,required:!0},block_name:{type:String,required:!0},element_id:{type:Number,required:!0},input_id:{type:Number,required:!0},label:{type:String,required:!0},value:{type:String,required:!1}},template:"\n\n\t\t\t<div\n\t\t\t\t:class=\"'mx_' + type\"\n\t\t\t>\n\n\t\t\t\t<label :for=\"block_name + '_element_' + element_id + '_input_' + input_id\">{{ label }}</label>\n\t\t\t\t<input\n\t\t\t\t\ttype=\"text\"\n\t\t\t\t\t:id=\"block_name + '_element_' + element_id + '_input_' + input_id\"\n\t\t\t\t\t:name=\"block_name + '_element_' + element_id + '_input_' + input_id\"\n\t\t\t\t\tv-model=\"input\"\n\t\t\t\t/>\n\n\t\t\t</div>\n\n\t\t",data:function(){return{input:null}},methods:{_emit_data:function(){var t=this.block_name,e=this.element_id,n=this.input_id,i=this.type,u=this.input,a=this.label;this.$emit("input_data",{block_name:t,element_id:e,input_id:n,input_type:i,value:u,label:a})}},watch:{input:function(){this._emit_data()}},mounted:function(){this.input=this.value}}),Vue.component("mx_textarea",{props:{type:{type:String,required:!0},block_name:{type:String,required:!0},element_id:{type:Number,required:!0},input_id:{type:Number,required:!0},label:{type:String,required:!0},value:{type:String,required:!1}},template:"\n\n\t\t\t<div\n\t\t\t\t:class=\"'mx_' + type\"\n\t\t\t>\n\t\t\t\t<label :for=\"block_name + '_element_' + element_id + '_input_' + input_id\">{{ label }}</label>\n\t\t\t\t<textarea\n\t\t\t\t\t:id=\"block_name + '_element_' + element_id + '_input_' + input_id\"\n\t\t\t\t\t:name=\"block_name + '_element_' + element_id + '_input_' + input_id\"\n\t\t\t\t\tv-model=\"input\"\n\t\t\t\t></textarea>\n\n\t\t\t</div>\n\n\t\t",data:function(){return{input:null}},methods:{_emit_data:function(){var t=this.block_name,e=this.element_id,n=this.input_id,i=this.type,u=this.input,a=this.label;this.$emit("input_data",{block_name:t,element_id:e,input_id:n,input_type:i,value:u,label:a})}},watch:{input:function(){this._emit_data()}},mounted:function(){this.input=this.value}}),Vue.component("mx_multibox_element",{props:{attrs:{type:Object,required:!0},block_name:{type:String,required:!0},element_id:{type:Number,required:!0}},template:'\n\n\t\t<div \n\t\t\tclass="mx_multibox_element"\n\t\t\t:class="\'mx_element_\' + element_id">\n\n\t\t\t<div\n\t\t\t\tv-for="(input, index) in attrs"\n\t\t\t>\n\n\t\t\t\t<div\n\t\t\t\t\tv-if="inputs_types.indexOf( input.type ) != -1"\n\t\t\t\t>\n\t\t\t\t\t<component \n\t\t\t\t\t\t:is="\'mx_\' + input.type"\n\t\t\t\t\t\t:label="input.label"\n\t\t\t\t\t\t:type="input.type"\n\t\t\t\t\t\t:value="input.value"\n\t\t\t\t\t\t:block_name="block_name"\n\t\t\t\t\t\t:element_id="parseInt( element_id )"\n\t\t\t\t\t\t:input_id="parseInt( index )"\n\n\t\t\t\t\t\t@input_data="push_input_data"\n\t\t\t\t\t></component>\n\n\t\t\t\t</div>\n\t\t\t\t<div v-else>\n\n\t\t\t\t\t<h3>The "{{ input.type }}" type doesn\'t exists!</h3>\n\n\t\t\t\t</div>\n\n\t\t\t</div>\n\n\t\t</div>\n\t\t',data:function(){return{inputs_types:["input-text","textarea"],inputs:[],element_data:{}}},methods:{push_input_data:function(i){var u=this;this.inputs.forEach(function(t,e){var n="mx_input"+i.input_id;Object.keys(u.inputs[e])[0]===n&&(u.inputs[e][n]=i.value)}),this.element_data[i.input_id]=i,this.$emit("element_data",this.element_data)},check_inputs_filed_in:function(){var i=this,u=!0;return this.inputs.forEach(function(t,e){var n=Object.keys(i.inputs[e]);i.inputs[e][n]||(u=!1)}),u}},watch:{inputs:{handler:function(t){var e=this.check_inputs_filed_in();this.$emit("add_new_element",e)},deep:!0}},mounted:function(){for(var t,e=0,n=Object.entries(this.attrs);e<n.length;e++){var i=b(n[e],2),u=i[0],u=(i[1],t=null,(i="mx_input"+u)in(u={})?Object.defineProperty(u,i,{value:t,enumerable:!0,configurable:!0,writable:!0}):u[i]=t,u);this.inputs.push(u)}}}),Vue.component("mx_multibox_block",{props:{block:{type:Object,required:!0},block_name:{type:String,required:!0},section_names:{type:Object,required:!0}},template:'\n\t\t\t<div class="mx_multibox_block mx-multibox_wrap">\n\n\t\t\t\t<h3>{{ section_names[block_name] }}</h3>\n\n\t\t\t\t<mx_multibox_element\n\n\t\t\t\t\tv-for="element in number_of_elements"\n\t\t\t\t\t:attrs="block"\n\t\t\t\t\t:block_name="block_name"\n\t\t\t\t\t:element_id="element"\n\t\t\t\t\t:key="element"\n\t\t\t\t\t@add_new_element="add_new_element"\n\t\t\t\t\t@element_data="push_element_data"\n\n\t\t\t\t></mx_multibox_element>\n\n\t\t\t\t<button\n\t\t\t\t\tclass="mx-add-block"\n\t\t\t\t\t@click.prevent="add_element"\n\t\t\t\t\tv-if="add_new"\n\t\t\t\t>Add</button>\n\n\t\t\t</div>\n\t\t',data:function(){return{number_of_elements:1,add_new:!1,block_data:{}}},methods:{push_element_data:function(t){for(var e=0,n=Object.entries(t);e<n.length;e++){var i=b(n[e],2),i=(i[0],i[1]);"object"!==c(this.block_data[i.block_name])&&(this.block_data[i.block_name]={}),this.block_data[i.block_name][i.element_id]=t}this.$emit("block_data",this.block_data)},add_new_element:function(t){this.add_new=t},add_element:function(){this.number_of_elements+=1}}}),null!==document.getElementById("mx_multibox_init")&&new Vue({el:"#mx_multibox_init",data:{multiboxes:mx_multiboxes,errors:[],blocks:{},time_out:null,save_data_input_id:mx_metabox_id,blocks_output_data:{},section_names:{}},methods:{save_data:function(t){for(var e=this,n=0,i=Object.entries(t);n<i.length;n++){var u=b(i[n],2),a=u[0],u=u[1];if("object"!==c(e.blocks_output_data[a])){e.blocks_output_data[a]={};for(var o=0,l=Object.entries(u);o<l.length;o++){var r=b(l[o],2),_=r[0],r=r[1];e.blocks_output_data[a][_]=r}}else for(var m=0,s=Object.entries(u);m<s.length;m++){var d=b(s[m],2),p=d[0],d=d[1];e.blocks_output_data[a][p]=d}}clearTimeout(this.time_out),this.time_out=setTimeout(function(){var t={action:"mx_convert_multibox",nonce:mx_multibox_localize.nonce,data:e.blocks_output_data,section_names:e.section_names};jQuery.post(mx_multibox_localize.ajax_url,t,function(t){jQuery("#"+e.save_data_input_id).val(t)})},500)},init_multibox:function(){if("object"===c(this.multiboxes)){for(var t=0,e=Object.entries(this.multiboxes);t<e.length;t++){var n=b(e[t],2),i=n[0],n=n[1];this.section_names[i]=n.section_name,delete this.multiboxes[i].section_name}this.blocks=this.multiboxes}}},mounted:function(){this.init_multibox()}})},{}]},{},[1]);
//# sourceMappingURL=vue-custom.js.map
