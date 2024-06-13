import './bootstrap';

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import * as bootstrap from 'bootstrap';
import mask from '@alpinejs/mask'

// window.Alpine = Alpine;
window.bootstrap = bootstrap;
Alpine.plugin(mask);
Livewire.start();
// Alpine.start()

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
