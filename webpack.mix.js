const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/dist/js")
    .js("resources/js/ckeditor-classic.js", "public/dist/js")
    .js("resources/js/ckeditor-inline.js", "public/dist/js")
    .js("resources/js/ckeditor-balloon.js", "public/dist/js")
    .js("resources/js/ckeditor-balloon-block.js", "public/dist/js")
    .js("resources/js/ckeditor-document.js", "public/dist/js")
    .css("public/dist/css/_app.css", "public/dist/css/app.css")
    .options({
        processCssUrls: false,
    })
    .copyDirectory("resources/json", "public/dist/json")
    .copyDirectory("resources/fonts", "public/dist/fonts")
    .copyDirectory("resources/images", "public/dist/images");