/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

console.log("miau");
if (false) {
    let cities = document.getElementById('cities');
    cities.addEventListener('change', function() {
        document.getElementById('cityfilter').submit();

    });
}

let selectedCells = [];

let cellsTaken = document.getElementsByClassName('yours');
for (let i = 0; i < cellsTaken.length; i++) {
    let cell = cellsTaken[i].getAttribute('value');
    selectedCells.push(cell);
}


let cells = document.getElementsByClassName('selectable');
console.log(cells.length);
for (let i = 0; i < cells.length; i++) {

    cells[i].addEventListener('click', function() {
        let cell = cells[i].getAttribute('value');

        if (!selectedCells.includes(cell)) {
            if (selectedCells.length >= 3) {
                return;
            }
            selectedCells.push(cell);
            cells[i].classList.add("green");
        } else {
            let id = selectedCells.indexOf(cell);
            selectedCells.splice(id, 1);
            cells[i].classList.remove("green");
        }
        console.log(selectedCells);
    });
}

document.getElementById('reg_form').addEventListener("submit", function() {
    document.getElementById('registrations').value = selectedCells;
    console.log(document.getElementById('registrations').value);
});


//  cells = document.getElementsByClassName('selected');
// for (let i = 0; i < cells.length; i++) {
//     let cell = cells[i].getAttribute('value');

//         selectedCells.push(cell);
// }