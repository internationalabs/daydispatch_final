const baseUrl = window.location.origin;
console.log(baseUrl);
document.writeln(
    `<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>`
);
document.writeln(
    `<script type="text/javascript" src="${baseUrl}/admin-backend/libs/choices.js/public/assets/scripts/choices.min.js"></script>`
);
document.writeln(
    `<script type="text/javascript" src="${baseUrl}/admin-backend/libs/flatpickr/flatpickr.min.js"></script>`
);
