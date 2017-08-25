CREATE TABLE item_category (id INT AUTO_INCREMENT, category VARCHAR(255) NOT NULL, subcategory VARCHAR(255) NOT NULL, PRIMARY KEY(id));

INSERT INTO item_category (id, category, subcategory) VALUES
(1, 'automotive','car'),
(2, 'automotive','truck'),
(3, 'electronics','computer'),
(4, 'electronics','home'),
(5, 'electronics','mobile'),
(6, 'electronics','music'),
(7, 'electronics','tv and media'),
(8, 'electronics','other'),
(9, 'fashion','boots'),
(10, 'fashion','dress'),
(11, 'fashion','jacket'),
(12, 'fashion','shirt'),
(13, 'fashion','trousers'),
(14, 'sport','basketball'),
(15, 'sport','football'),
(16, 'sport','handball'),
(17, 'sport','volleyball');
