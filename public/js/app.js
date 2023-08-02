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

//-----------------

document.querySelectorAll('.main-tab-btn').forEach((btn) => {
    btn.addEventListener('click', (event) => {
        document.querySelectorAll('.tab').forEach((tab) => tab.classList.remove('active'));

        const tab = event.currentTarget.getAttribute('data-tab');
        document.querySelector(`#tab-${tab}`).classList.add('active');

    });
});


document.querySelectorAll('.main-tab-btn-inside').forEach((btn) => {
    btn.addEventListener('click', (event) => {
        document.querySelectorAll('.tab-inside').forEach((tab) => tab.classList.remove('active'));

        const tab = event.currentTarget.getAttribute('data-tab');
        document.querySelector(`#tab-${tab}`).classList.add('active');

    });
});
