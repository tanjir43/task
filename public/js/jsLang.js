window.jsLang = function (key) {
    const translations = {
        'select_country'    : 'Select Country',
        'select_city'       : 'Select City',
        'select_event'      : 'Select Event',
        'select_user'       : 'Select User',
        'all_user'          : 'All User',
    };
    return translations[key] || key;
};
