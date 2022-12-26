
Нужно написать справочник по музыкальным альбомам.

Модели:

Исполнитель:
Имя/Название;
Фотография (файл с изображением).
Альбом:
Название;
Описание;
Исполнитель;
Обложка (файл с изображением).

4 экрана:

1-й экран: список альбомов:
название,
исполнитель,
описание,
обложка,
с фильтрацией по исполнителю,
и пагинацией: 5 записей на экране.
2-й экран: форма редактирования/создания/удаления альбома:
В форме должна быть возможность предзаполнения полей исполнитель, описание, обложка по названию альбома из API last.fm.
Редактировать форму может только авторизованный пользователь.
Изменения данных о пластинке необходимо логировать.
3-й экран: список исполнителей:
имя/название,
фотография (файл с изображением),
с фильтрацией по имени,
и пагинацией: 5 записей на экране.
4-й экран: форма редактирования/создания/удаления исполнителя.
В форме должна быть возможность предзаполнения по имени/названию исполнителя (фотография) из API last.fm.
Редактировать форму может только авторизованный пользователь.
Изменения данных по пластинке необходимо логировать.

Дополнительно:

Сделать нужно с использованием Laravel.
СУБД можно использовать любую.
При удалении модели — удалять изображения.

Нюансы, которые не описаны в задании сделай на своё усмотрение или задай вопрос.

Требования к результату:

Ссылка на исходный код в любой общедоступной системе контроля версий;
Ссылка на демонстрацию приложения в рабочем виде, его нужно развернуть на любом бесплатном (или платном) хостинге.
