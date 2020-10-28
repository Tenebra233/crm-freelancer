<template>
    <div id="form-main">
        <div id="form-div">
            <p class="subject">
                <input name="name" type="text"
                       class="feedback-input" v-model="emailSubject" placeholder="Subject"
                       id="subject"/>
            </p>
            <div id="defaultRTE">
                <ejs-richtexteditor v-model="emailBody" ref="defaultRTE" :height="340">
                </ejs-richtexteditor>
            </div>

            <p class="template">
                <v-selectize v-model="selectedTemplate" :limit="3" :options="getTemplateResponse"/>
            </p>

            <div class="submit">
                <ejs-progressbutton ref="progressBtn" :enableProgress="false" v-on:click.native="sendEmail()" content="SEND"></ejs-progressbutton>
            </div>
            <br>
            <br>
            <h3 style="color: green">{{this.emailSentResponse}}</h3>
        </div>
    </div>

</template>

<script>
    import {Toolbar, Link, Image, Count, HtmlEditor, QuickToolbar} from "@syncfusion/ej2-vue-richtexteditor";

    export default {

        provide: {
            richtexteditor: [Toolbar, Link, Image, Count, HtmlEditor, QuickToolbar]
        },

        props: ['resourceName', 'resourceId', 'panel'],

        data()
        {
            return {
                emailSentResponse: '',
                emailBody: '',
                emailSubject: '',
                selectedTemplate: '',
                getTemplateResponse: [],
                selectedTemplateResponse: '',
            }
        },

        mounted()
        {
            // this.getTemplate();
            this.getTemplate();
        },

        watch: {
            selectedTemplate: function (newQuestion, oldQuestion)
            {
                this.selectTemplateEvent()
            }
        },

        methods: {
            sendEmail()
            {
                Nova.request().post('/nova-vendor/email-sender-tool/getCustomerEmail', {
                    'orderId': this.resourceId,
                    'emailBody': this.emailBody,
                    'emailSubject': this.emailSubject,
                })
                    .then((response) =>
                    {
                        this.emailSentResponse = response.data;
                        this.$refs.progressBtn.stop();
                    });
            },
            selectTemplateEvent()
            {
                Nova.request().post('/nova-vendor/email-sender-tool/selectTemplateEvent', {
                    'name': this.selectedTemplate,
                })
                    .then((response) =>
                    {
                        this.selectedTemplateResponse = response.data;
                        this.emailSubject = this.selectedTemplateResponse['subject'];
                        this.emailBody = this.selectedTemplateResponse['body'];

                    });
            },

            getTemplate()
            {
                Nova.request().get('/nova-vendor/email-sender-tool/getTemplate')
                    .then((response) =>
                    {
                        this.getTemplateResponse = response.data;
                    });
            }

        }
    }
</script>
<style>


    @import url(https://fonts.googleapis.com/css?family=Montserrat:400,700);


    /*#form-main {*/
    /*    width: 100%;*/
    /*    float: left;*/
    /*    padding-top: 0px;*/
    /*}*/


    .feedback-input {
        color: #3c3c3c;
        font-family: Helvetica, Arial, sans-serif;
        font-weight: 500;
        font-size: 18px;
        border-radius: 0;
        line-height: 22px;
        background-color: #fbfbfb;
        padding: 13px 13px 13px 54px;
        margin-bottom: 10px;
        width: 100%;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        -ms-box-sizing: border-box;
        box-sizing: border-box;
        border: 3px solid rgba(0, 0, 0, 0);
    }

    .feedback-input:focus {
        background: #fff;
        box-shadow: 0;
        border: 3px solid #3498db;
        color: #3498db;
        outline: none;
        padding: 13px 13px 13px 54px;
    }

    .focused {
        color: #30aed6;
        border: #30aed6 solid 3px;
    }

    /* Icons ---------------------------------- */
    #subject {
        background-image: url(http://rexkirby.com/kirbyandson/images/name.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    #subject:focus {
        background-image: url(http://rexkirby.com/kirbyandson/images/name.svg);
        background-size: 30px 30px;
        background-position: 8px 5px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    #email {
        background-image: url(http://rexkirby.com/kirbyandson/images/email.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    #email:focus {
        background-image: url(http://rexkirby.com/kirbyandson/images/email.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    #comment {
        background-image: url(http://rexkirby.com/kirbyandson/images/comment.svg);
        background-size: 30px 30px;
        background-position: 11px 8px;
        background-repeat: no-repeat;
    }

    textarea {
        width: 100%;
        height: 150px;
        line-height: 150%;
        resize: vertical;
    }

    input:hover, textarea:hover,
    input:focus, textarea:focus {
        background-color: white;
    }

    #button-blue {
        font-family: 'Montserrat', Arial, Helvetica, sans-serif;
        float: left;
        width: 100%;
        border: #fbfbfb solid 4px;
        cursor: pointer;
        background-color: #3498db;
        color: white;
        font-size: 24px;
        padding-top: 22px;
        padding-bottom: 22px;
        margin-top: -4px;
        font-weight: 700;
    }

    #button-blue:hover {
        background-color: rgba(0, 0, 0, 0);
        color: #0493bd;
    }

    .submit:hover {
        color: #3498db;
    }

    .ease {
        width: 0px;
        height: 74px;
        background-color: #fbfbfb;
        -webkit-transition: .3s ease;
        -moz-transition: .3s ease;
        -o-transition: .3s ease;
        -ms-transition: .3s ease;
        transition: .3s ease;
    }

    .submit:hover .ease {
        width: 100%;
        background-color: white;
    }

    @media only screen and (max-width: 580px) {
        #form-div {
            left: 3%;
            margin-right: 3%;
            width: 88%;
            margin-left: 0;
            padding-left: 3%;
            padding-right: 3%;
        }
    }
</style>
