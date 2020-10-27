import {RichTextEditorPlugin, Toolbar, Link, Image, Count, HtmlEditor, QuickToolbar} from "@syncfusion/ej2-vue-richtexteditor";

Nova.booting((Vue, router, store) =>
{
    Vue.component('email-sender-tool', require('./components/Tool'));
    Vue.use(RichTextEditorPlugin);
    require("/var/www/html/crm-freelancer/nova-components/EmailSenderTool/node_modules/@syncfusion/ej2-vue-richtexteditor/styles/material.css");
    require("/var/www/html/crm-freelancer/nova-components/EmailSenderTool/node_modules/@syncfusion/ej2-splitbuttons/styles/material.css");
    require("/var/www/html/crm-freelancer/nova-components/EmailSenderTool/node_modules/@syncfusion/ej2-navigations/styles/material.css");
    require("/var/www/html/crm-freelancer/nova-components/EmailSenderTool/node_modules/@syncfusion/ej2-buttons/styles/material.css");
    require("/var/www/html/crm-freelancer/nova-components/EmailSenderTool/node_modules/@syncfusion/ej2-popups/styles/material.css");
    require("/var/www/html/crm-freelancer/nova-components/EmailSenderTool/node_modules/@syncfusion/ej2-lists/styles/material.css");
    require("/var/www/html/crm-freelancer/nova-components/EmailSenderTool/node_modules/@syncfusion/ej2-inputs/styles/material.css");
    require("/var/www/html/crm-freelancer/nova-components/EmailSenderTool/node_modules/@syncfusion/ej2-base/styles/material.css");


})
