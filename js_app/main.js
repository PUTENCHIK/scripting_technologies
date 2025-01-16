const { createApp } = Vue

createApp({
    data() {
        return {
            activePage: 1,
            notes: {},
            labels: {},
            showForm: null,
            formTitle: '',
            submitButtonText: '',
            showTextColorPicker: false,
            formErrors: {},
            formData: {},
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
            this.formTitle = 'Добавление заметки';
            this.submitButtonText = 'Добавить';
            this.formData = {};
        },

        addLabelClicked() {
            this.showForm = 2;
            this.activePage = 2;
            this.showTextColorPicker = false;
            this.formTitle = 'Добавление метки';
            this.submitButtonText = 'Добавить';
            this.formData = {};
        },

        editNoteClicked(id) {
            this.showForm = 1;
            this.showTextColorPicker = false;
            this.formTitle = `Изменение заметки #${id}`;
            this.submitButtonText = 'Применить';
            this.formData = this.notes[id];
            this.formData['id'] = Number(id);
        },

        editLabelClicked(id) {
            this.showForm = 2;
            this.showTextColorPicker = false;
            this.formTitle = `Изменение метки #${id}`;
            this.submitButtonText = 'Применить';
            this.formData = this.labels[id];
            this.formData['id'] = Number(id);
        },

        formHandle(event) {
            if (this.showForm === 1) {
                if ('id' in this.formData) {
                    this.editNote(event);
                } else {
                    this.addNote(event);
                }
            } else {
                if ('id' in this.formData) {
                    this.editLabel(event);
                } else {
                    this.addLabel(event);
                }
            }
        },

        validateNote(data) {
            this.formErrors = {};
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
            return labels;
        },

        addNote(event) {
            event.preventDefault();
            let data = new FormData(event.target);
            let labels = this.validateNote(data);

            if (Object.keys(this.formErrors).length === 0) {
                MyLocalStorage.add_note(data.get('title'), data.get('text'), labels);
                this.showForm = null;
                this.updateData();
            }
        },

        editNote(event) {
            event.preventDefault();
            let data = new FormData(event.target);
            let labels = this.validateNote(data);

            if (Object.keys(this.formErrors).length === 0) {
                MyLocalStorage.edit_note(this.formData.id, data.get('title'), data.get('text'), labels);
                this.showForm = null;
                this.updateData();
            }
        },

        validateLabel(data) {
            this.formErrors = {};

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

            return tcolor;
        },

        addLabel(event) {
            event.preventDefault();
            let data = new FormData(event.target);
            let tcolor = this.validateLabel(data);

            if (Object.keys(this.formErrors).length === 0) {
                MyLocalStorage.add_label(data.get('name'), data.get('bcolor'), tcolor);
                this.showForm = null;
                this.updateData();
            }
        },

        editLabel(event) {
            event.preventDefault();
            let data = new FormData(event.target);
            let tcolor = this.validateLabel(data);

            if (Object.keys(this.formErrors).length === 0) {
                MyLocalStorage.edit_label(this.formData.id, data.get('name'), data.get('bcolor'), tcolor);
                this.showForm = null;
                this.updateData();
            }
        },

        deleteNote(id) {
            MyLocalStorage.delete_note(id);
            this.updateData();
        },

        deleteLabel(id) {
            MyLocalStorage.delete_label(id);
            this.updateData();
        },

        clearNotes() {
            MyLocalStorage.clear_notes();
            this.updateData();
        },

        clearLabels() {
            MyLocalStorage.clear_labels();
            this.updateData();
        },

        clearAll() {
            MyLocalStorage.clear_all();
            this.updateData();
        }
    },

    mounted: function() {
        try {
            MyLocalStorage.create();
        } catch {}

        this.updateData();
    }
}).mount('#main');