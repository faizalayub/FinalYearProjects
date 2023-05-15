import { createApp } from "vue";
import dashboard from './chat.vue';

window.chatmodule = function(el, props = {}){
    let mountInstance = createApp(dashboard, props);

    mountInstance.mount(el);
};