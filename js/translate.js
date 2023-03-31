
    function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'en',
        includedLanguages:'en,fr,nl'
    }, 'google_translate_element');
    setTimeout(function(){
    var select = document.querySelector('select.goog-te-combo');
    select.value    = "en";
    select.dispatchEvent(new Event('change'));
},1000)
}
