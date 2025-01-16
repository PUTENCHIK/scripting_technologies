const { createApp } = Vue

createApp({
    data() {
        return {
            activePage: 1,
            notes: {},
            labels: {},
            showForm: 1,
            showTextColorPicker: false,
            formErrors: {},
        }
    },

    methods: {
        updateData() {
            let storage = MyLocalStorage.get();
            this.notes = storage.notes;
            this.labels = storage.labels;
            console.log(storage);
        },

        getLabel(id) {
            return this.labels[id];
        },

        addNoteClicked() {
            this.showForm = 1;
            this.activePage = 1;
            this.showTextColorPicker = false;
        },

        addLabelClicked() {
            this.showForm = 2;
            this.activePage = 2;
            this.showTextColorPicker = false;
        },

        formHandle(event) {
            if (this.showForm === 1) {
                this.addNote(event);
            } else {
                this.addLabel(event);
            }
        },

        addNote(event) {
            event.preventDefault();
            this.formErrors = {};
            let data = new FormData(event.target);

            if (!data.get('title').length) {
                this.formErrors['title'] = 'Необходимо заполнить заголовок';
            }
            if (!data.get('text').length) {
                this.formErrors['text'] = 'Необходимо добавить комментарий';
            }

            let labels = [];
            for (let pair of data.entries()) {
                let key = pair[0];
                let value = pair[1];
                if (!['title', 'text'].includes(key) && value === 'on') {
                    let label = Number(key);
                    if (labels.includes(label)) {
                        this.formErrors['labels'] = 'Найдены повторяющиеся метки';
                        break;
                    } else {
                        labels.push(label);
                    }
                }
            }

            if (Object.keys(this.formErrors).length === 0) {
                MyLocalStorage.add_note(data.get('title'), data.get('text'), labels);
                this.showForm = null;
                this.updateData();
            }
        },

        addLabel(event) {
            event.preventDefault();
            this.formErrors = {};

            let data = new FormData(event.target);
            let tcolor;
            if (data.get('tcolor') === 'own') {
                tcolor = data.get('tcolor_picker');
            } else {
                tcolor = data.get('tcolor');
            }

            if (!data.get('name').length) {
                this.formErrors['name'] = 'Название необходимо заполнить';
            }
            if (data.get('bcolor') === tcolor) {
                this.formErrors['colors'] = 'Цвет фона и текста должны различаться';
            }          

            if (Object.keys(this.formErrors).length === 0) {
                MyLocalStorage.add_label(data.get('name'), data.get('bcolor'), tcolor);
                this.showForm = null;
                this.updateData();
            }
        },

        deleteLabel(id) {
            MyLocalStorage.delete_label(id);
            this.updateData();
        },
    },

    mounted: function() {
        try {
            MyLocalStorage.create();
        } catch {}

        // MyLocalStorage.add_label("Важно", "#ff0000", "#ffffff");
        // MyLocalStorage.add_label("Не откладывать", "#00ff00", "#ffffff");
        // MyLocalStorage.add_label("Мусор", "#cccccc", "#000000");
        // MyLocalStorage.add_note("Уволить Дэнни", "Не откладывать, он опасен", [1, 2]);
        // MyLocalStorage.add_note("Заработать свой миллион", "Пофиг", [3]);

        this.updateData();
    }
}).mount('#main');