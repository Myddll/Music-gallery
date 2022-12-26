import './bootstrap';
import './config';

let	artist = document.getElementById('artist');
let artistDatalist = document.getElementById('datalist_artist');
let artistPhoto = document.getElementById('photo');

async function getArtists(value)
{
    artistDatalist.innerHTML = '';
    let response = await fetch(`http://${PATH}/api/artist/${value}/search`);
    let content = await response.json();


    content.forEach(function (item) {
        let element = document.createElement("option");
        element.innerHTML = item.name;
        artistDatalist.appendChild(element);
    })
    console.log(content);
}

async function getPhoto(value)
{
    let response = await fetch(`http://localhost:8000/api/artist/${value}`);
    let content = await response.json();

    artistPhoto.value = content.photo;
    console.log(content);
}

artist.oninput = function () {
    getArtists(artist.value);
}

artist.onchange = async function () {
    await getPhoto(artist.value);
};






