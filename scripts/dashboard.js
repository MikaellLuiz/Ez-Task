function showIframe(id) {
    // Oculta todos os iframes
    var iframes = document.querySelectorAll('iframe');
    for (var i = 0; i < iframes.length; i++) {
        iframes[i].style.display = 'none';
    }

    var iframe = document.getElementById(id);
    if (iframe) {
        iframe.style.display = 'block';
    }
}