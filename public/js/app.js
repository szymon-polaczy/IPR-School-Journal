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

const lesson_clicking = () => {
    const events = document.querySelectorAll(".fc-event");
    if (events) {
        events.forEach(lesson => {
            lesson.addEventListener('click', () => {
                document.querySelector('#lesson-popup').classList.add('opened-popup');

                const lesson_obj = JSON.parse(lesson.getAttribute('data-lesson'));

                document.querySelector('#delete-lesson-btn').setAttribute('action', `/delete-lesson/${lesson_obj.id}`);
                document.querySelector('#lesson-popup #edit-lesson').setAttribute('action', `/edit-lesson/${lesson_obj.id}`);

                document.querySelector('#lesson-popup #teacher_id').value = lesson_obj.teacher_id;
                document.querySelector('#lesson-popup #subject_id').value = lesson_obj.subject_id;
                document.querySelector('#lesson-popup #room_id').value = lesson_obj.room_id;
                document.querySelector('#lesson-popup #start').value = lesson_obj.start;
                document.querySelector('#lesson-popup #end').value = lesson_obj.end;
            });
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    lesson_clicking();

    document.querySelector('.fc-prev-button').addEventListener('click', () => {
        lesson_clicking();
    });

    document.querySelector('.fc-next-button').addEventListener('click', () => {
        lesson_clicking();
    });
});


const btn_lesson_popup_close = document.querySelector('#btn-lesson-popup-close');
if (btn_lesson_popup_close) {
    btn_lesson_popup_close.addEventListener('click', () => {
        document.querySelector('#lesson-popup').classList.remove('opened-popup');
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
