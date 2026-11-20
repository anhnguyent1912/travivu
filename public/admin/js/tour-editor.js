const form = document.getElementById('tour-form');
const tabList = form.querySelector('[role="tablist"]');
const tabs = Array.from(tabList.querySelectorAll('[role="tab"]'));

function openTab(tab) {
    for (const button of tabs) {
        const selected = button === tab;
        button.setAttribute('aria-selected', String(selected));
        button.tabIndex = selected ? 0 : -1;
        document.getElementById(button.getAttribute('aria-controls')).hidden = !selected;
    }
}

tabList.hidden = false;
openTab(document.getElementById('tab-' + form.dataset.activeTab));
tabs.forEach((tab, index) => {
    tab.addEventListener('click', () => openTab(tab));
    tab.addEventListener('keydown', event => {
        const positions = {
            ArrowRight: (index + 1) % tabs.length,
            ArrowLeft: (index + tabs.length - 1) % tabs.length,
            Home: 0,
            End: tabs.length - 1,
        };
        if (!(event.key in positions)) return;
        event.preventDefault();
        const next = tabs[positions[event.key]];
        openTab(next);
        next.focus();
    });
});

// Reveal the first invalid field before the browser tries to focus it.
form.addEventListener('invalid', event => {
    if (event.target !== form.querySelector('input:invalid, select:invalid, textarea:invalid')) return;
    const panel = event.target.closest('[role="tabpanel"]');
    if (panel) openTab(document.getElementById(panel.getAttribute('aria-labelledby')));
}, true);

const dayList = document.getElementById('timeline-list');
dayList.addEventListener('input', event => {
    if (event.target.matches('input:not([type="hidden"])')) {
        event.target.closest('details').querySelector('.day-caption').textContent = event.target.value.trim();
    }
});

document.getElementById('add-day').addEventListener('click', () => {
    const index = dayList.children.length;
    const day = dayList.firstElementChild.cloneNode(true);
    day.querySelector('summary strong').textContent = 'Ngày ' + (index + 1);
    day.querySelector('.day-caption').textContent = '';
    day.querySelector('input[type="hidden"]')?.remove();

    for (const [field, control] of [['title', day.querySelector('input')], ['description', day.querySelector('textarea')]]) {
        day.querySelector('label[for="' + control.id + '"]').htmlFor = 'day-' + field + '-' + index;
        control.id = 'day-' + field + '-' + index;
        control.name = 'timeline[' + index + '][' + field + ']';
        control.value = '';
    }
    day.open = true;
    dayList.appendChild(day);
    day.querySelector('input').focus();
});

const priceFormat = new Intl.NumberFormat('vi-VN');
function updatePreview() {
    for (const [field, placeholder] of [['title', 'Tên tour'], ['destination', 'Điểm đến'], ['time', 'Thời lượng']]) {
        document.getElementById('preview-' + field).textContent = form.elements[field].value.trim() || placeholder;
    }
    const amount = form.elements.priceAdult.valueAsNumber;
    document.getElementById('preview-price').textContent = Number.isFinite(amount) ? priceFormat.format(amount) + ' đ' : '—';
}
document.getElementById('panel-general').addEventListener('input', updatePreview);
updatePreview();

const photos = document.getElementById('tour-images');
const thumbnails = document.getElementById('tour-thumbnails');
const originalPhotos = Array.from(thumbnails.children);
const cover = document.getElementById('preview-cover');
const originalCover = cover.getAttribute('src');
let selectedUrls = [];

photos.addEventListener('change', () => {
    selectedUrls.forEach(url => URL.revokeObjectURL(url));
    selectedUrls = [];
    const files = Array.from(photos.files);
    let error = '';
    if (files.length > 5) error = 'Vui lòng chọn tối đa 5 ảnh.';
    else if (files.some(file => file.size > 5 * 1024 * 1024)) error = 'Mỗi ảnh được có dung lượng tối đa 5 MB.';
    photos.setCustomValidity(error);

    thumbnails.replaceChildren(...originalPhotos);
    if (files.length && !error) {
        thumbnails.replaceChildren();
        for (const file of files) {
            const url = URL.createObjectURL(file);
            selectedUrls.push(url);
            const figure = document.createElement('figure');
            figure.className = 'm-0';
            const image = document.createElement('img');
            image.className = 'tour-photo';
            image.alt = '';
            image.src = url;
            const caption = document.createElement('figcaption');
            caption.className = 'small';
            caption.textContent = selectedUrls.length === 1 ? 'Ảnh bìa' : 'Ảnh ' + selectedUrls.length;
            figure.append(image, caption);
            thumbnails.appendChild(figure);
        }
    }
    const src = selectedUrls[0] || originalCover;
    if (src) cover.src = src;
    else cover.removeAttribute('src');
    cover.hidden = !src;
    document.getElementById('empty-cover').hidden = Boolean(src);
    if (error) photos.reportValidity();
});
