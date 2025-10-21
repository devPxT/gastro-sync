// js/app.js
window.showAlert = function(message, type = 'info') {
    // type could be 'info','success','warning','danger' - we use browser alert for simplicity
    alert(message);
};

// show flash if set by server (session flash)
document.addEventListener('DOMContentLoaded', function() {
    // server injects FC_FLASH_MESSAGE var if needed
    if (typeof FC_FLASH_MESSAGE !== 'undefined' && FC_FLASH_MESSAGE) {
        showAlert(FC_FLASH_MESSAGE);
    }
});
