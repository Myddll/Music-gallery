import './bootstrap';
import './config';

let	albumTitle = document.getElementById('album_title');
let albumDatalist = document.getElementById('datalist_album');
let artistName = document.getElementById('artist_name');
let description = document.getElementById('description');
let albumCover = document.getElementById('cover');

async function getAlbumTitle(value)
{
    albumTitle.innerHTML = '';
    let response = await fetch(`http://${PATH}/api/album/${value}/search`);
    let content = await response.json();

    content.forEach(function (item) {
        let element = document.createElement("option");
        element.innerHTML = item.name;
        albumDatalist.appendChild(element);
    })
}

async function getDescription(value)
{
    let response = await fetch(`http://localhost:8000/api/artist/${value}/description`);
    let content = await response.json();

    value = content.description;
    description.value = value;
}

async function getCover(albumValue, artistValue)
{
    let response = await fetch(`http://localhost:8000/api/albumCover/${albumValue}/${artistValue}`);
    let content = await response.json();

    albumCover.value = content.cover;
}

albumTitle.oninput = function () {
    getAlbumTitle(albumTitle.value);
}

artistName.onchange = function () {
    getDescription(artistName.value);
    getCover(albumTitle.value, artistName.value);
};










