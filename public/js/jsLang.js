window.jsLang = function (key) {
    const translations = {
        'select_country'    : 'Select Country',
        'select_city'       : 'Select City',
    };
    return translations[key] || key;
};
