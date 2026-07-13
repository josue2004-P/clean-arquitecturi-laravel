import './bootstrap';
import ApexCharts from 'apexcharts';
import Swal from 'sweetalert2';
import $ from 'jquery';

import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';

import { Calendar } from '@fullcalendar/core';

window.ApexCharts = ApexCharts;
window.flatpickr = flatpickr;
window.FullCalendar = Calendar;
window.Swal = Swal;
window.jQuery = window.$ = $;
