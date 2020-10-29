import {
    RichTextEditorPlugin,
    Toolbar,
    Link,
    Image,
    Count,
    HtmlEditor,
    QuickToolbar
} from "@syncfusion/ej2-vue-richtexteditor";
import VSelectize from '@isneezy/vue-selectize'
import VueButtonSpinner from 'vue-button-spinner';

Nova.booting((Vue, router, store) => {

    Vue.component('email-sender-tool', require('./components/Tool'));
    Vue.component('v-selectize', VSelectize);
    Vue.component('vue-button-spinner', VueButtonSpinner);
    Vue.use(RichTextEditorPlugin);
    Vue.use(VSelectize);
    Vue.use(VueButtonSpinner);

    //CSS RICHTEXT INPUT
    require("/var/www/html/crm-freelancer/nova-components/EmailSenderTool/node_modules/@syncfusion/ej2-vue-richtexteditor/styles/material.css");
    require("/var/www/html/crm-freelancer/nova-components/EmailSenderTool/node_modules/@syncfusion/ej2-splitbuttons/styles/material.css");
    require("/var/www/html/crm-freelancer/nova-components/EmailSenderTool/node_modules/@syncfusion/ej2-navigations/styles/material.css");
    require("/var/www/html/crm-freelancer/nova-components/EmailSenderTool/node_modules/@syncfusion/ej2-buttons/styles/material.css");
    require("/var/www/html/crm-freelancer/nova-components/EmailSenderTool/node_modules/@syncfusion/ej2-popups/styles/material.css");
    require("/var/www/html/crm-freelancer/nova-components/EmailSenderTool/node_modules/@syncfusion/ej2-lists/styles/material.css");
    require("/var/www/html/crm-freelancer/nova-components/EmailSenderTool/node_modules/@syncfusion/ej2-inputs/styles/material.css");
    require("/var/www/html/crm-freelancer/nova-components/EmailSenderTool/node_modules/@syncfusion/ej2-base/styles/material.css");

    //CSS SELECTIZE
    require('selectize/dist/css/selectize.css');


})
