import Vue from 'vue'
import * as global from "./global.js";

const mixin = {
    computed:global.computed,
    components:global.components,
    methods:global.methods,
    mounted(){
        var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
        elems.forEach(function(html) {
            var switchery = new Switchery(html);
        });
    }
}

export default mixin