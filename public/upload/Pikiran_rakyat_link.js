let link = [];
// Akses semua element anchor (a)
let anchor = document.getElementsByTagName('a');
// Looping sebanyak anchor
for (j = 0; j < anchor.length; j++) {
    // ambil value href dari anchor
    let href = anchor[j].getAttribute('href');
    // split href agar bisa di cek link yang ada dalam subdomain money.kompas.com
    let split = href.split('/');
    // console.log(spl);
    // Jika isi dari href sudah ada dalam array link dan link masih dalam cakupan kategori ekonomi
    if (!link.includes(href) && split[2] == "www.pikiran-rakyat.com" && split[3] == "ekonomi" && split[4]) {
        link.push(href);
    }
}
document.body.innerHTML = "";
let list_link = JSON.stringify(link);
let form = document.createElement('form');
form.setAttribute('method','POST');
form.setAttribute('action','');
let input = `
<input type="text" name='data_list' value="${list_link}">
`;
form.innerHTML = input;