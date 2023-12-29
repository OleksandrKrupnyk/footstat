import './bootstrap';

import Alpine from 'alpinejs';
import {Datepicker, initTE, Input, Rating} from "tw-elements";

window.Alpine = Alpine;

Alpine.start();

initTE({ Datepicker, Input ,Rating});
