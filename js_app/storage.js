class MyLocalStorage {

    static name = "js_app_by_olifirenko";

    static check_exists() {
        return localStorage[this.name] !== undefined;
    }

    static create() {
        if (this.check_exists()) {
            throw new Error(`Local storage with name '${this.name}' is already exists.`);
        }
        let storage = {
            "data": {
                "max_note_id": 0,
                "max_label_id": 0,
            },
            "notes": {},
            "labels": {},
        };
        this.set(storage);
    }

    static get() {
        if (!this.check_exists()) {
            throw new Error(`Local storage '${this.name}' doesn't exist`);
        }
        return JSON.parse(localStorage[this.name]);
    }

    static set(new_content) {
        localStorage[this.name] = JSON.stringify(new_content);
    }

    static add_note(title, text, labels) {
        let storage = this.get();
        storage.data.max_note_id++;

        let new_note = {
            title: title,
            text: text,
            labels: labels,
            created_at: (new Date()).toString()
        }

        storage.notes[storage.data.max_note_id] = new_note;
        this.set(storage);
    }

    static edit_note(id, title, text, labels) {
        let storage = this.get();

        storage.notes[id].title = title;
        storage.notes[id].text = text;
        storage.notes[id].labels = labels;

        this.set(storage);
    }

    static add_label(name, bcolor, tcolor) {
        let storage = this.get();
        storage.data.max_label_id++;

        let new_label = {
            name: name,
            bcolor: bcolor,
            tcolor: tcolor,
            created_at: (new Date()).toString()
        }

        storage.labels[storage.data.max_label_id] = new_label;
        this.set(storage);
    }

    static edit_label(id, name, bcolor, tcolor) {
        let storage = this.get();

        storage.labels[id].name = name;
        storage.labels[id].bcolor = bcolor;
        storage.labels[id].tcolor = tcolor;

        this.set(storage);
    }

    static get_note(id) {
        let storage = this.get();
        return storage.notes[id];
    }

    static get_label(id) {
        let storage = this.get();
        return storage.labels[id];
    }

    static delete_note(id) {
        let storage = this.get();
        for (let note_id in storage.notes) {            
            if (note_id == id) {
                delete storage.notes[id];
                break;
            }
        }
        this.set(storage);
    }

    static delete_label(id) {
        let storage = this.get();
        for (let label_id in storage.labels) {            
            if (label_id == id) {
                delete storage.labels[id];
                console.log('deleted label', id);
                
                break;
            }
        }
        for (let note_id in storage.notes) {            
            if (storage.notes[note_id].labels.includes(Number(id))) {
                console.log('deleted label', id, 'from note', note_id);
                
                storage.notes[note_id].labels.shift(Number(id));
            }
        }
        this.set(storage);
    }

    static clear_notes() {
        let storage = this.get();
        storage.data.max_note_id = 0;
        storage.notes = {};
        this.set(storage);
    }

    static clear_labels() {
        let storage = this.get();
        storage.data.max_label_id = 0;
        storage.labels = {};

        for (let note_id in storage.notes) {            
            storage.notes[note_id].labels = [];
        }

        this.set(storage);
    }

    static clear_all() {
        this.clear_notes();
        this.clear_labels();
    }
}