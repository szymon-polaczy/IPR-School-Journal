const btn_create_users_popup = document.querySelector('#btn-create-user-popup');
if (btn_create_users_popup) {
    btn_create_users_popup.addEventListener('click', () => {
        document.querySelector('#create-user-form').classList.add('opened-popup');
    });
}

const btn_create_users_popup_close = document.querySelector('#btn-create-user-popup-close');
if (btn_create_users_popup_close) {
    btn_create_users_popup_close.addEventListener('click', () => {
        document.querySelector('#create-user-form').classList.remove('opened-popup');
    });
}
