// deklarasi link
let link = [];
        
// Akses semua element anchor (a)
let anchor = document.getElementsByTagName('a');

// Looping sebanyak anchor
for (j = 0; j < anchor.length; j++) {
    // ambil value href dari anchor
    let href = anchor[j].getAttribute('href');
    // split href agar bisa di cek link yang ada dalam subdomain money.kompas.com
    let split = href.split('.');
    // Jika isi dari href sudah ada dalam array link dan link masih dalam cakupan kategory money
    if (!link.includes(href) && split[0] == "https://money") {
        link.push(href);
    }
}
// let link : array yang berisi link baca artikel
document.body.innerHTML = JSON.stringify(link);