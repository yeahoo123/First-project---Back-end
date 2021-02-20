var dictionary = {
    'home page': {
        'vn': 'Trang chủ',
        'en': 'Home Page',
        },
     'language': {
        'vn': 'Đổi ngôn ngữ',
        'en': 'Change language',
    },
     'contact': {
        'vn': 'Liên hệ',
        'en': 'Contact',
    },
     'forgot': {
        'vn': 'Bạn quên mật khẩu?',
        'en': 'Forgot password?',
    },
    //  'contact': {
    //     'vn': 'Liên hệ',
    //     'en': 'Contact',
    // }
};

var langs = ['vn', 'en'];
var current_lang_index = 0;
var current_lang = langs[current_lang_index];

window.change_lang = function() {
current_lang_index = ++current_lang_index % 2;
current_lang = langs[current_lang_index];
translate();
}

function translate() {
$("[data-translate]").each(function(){
    var key = $(this).data('translate');
    $(this).html(dictionary[key][current_lang] || "N/A");
});
}

translate();