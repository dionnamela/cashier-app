import './bootstrap';

document.addEventListener('livewire:navigated', () => {
    window.initFlowbite();
});