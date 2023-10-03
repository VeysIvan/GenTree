# GenTree
GenTree JSON From CSV
 
 Модуль, генерирующий JSON файл на основе входящего CSV файла.
 _____________________

 Требования
 php версии 8.1+
 ОС: Ubuntu/Debian
 _____________________

 Быстрый запуск:
 # php start.php [input file] [output file]

 Модуль поджерживает работу с входным файлом типа CSV с разделителем ";".
 Выходные данные в формате JSON. В качестве примера структуры CSV input.csv.
 _____________________

 Для работы с GenTree:

 component - любой элемент из иерархии дерева (по ум. самый верх).

 # new GenTree(string [input file], string [output file])  GenTree Obj
 - создание нового представления компонентов дерева;

 # [GenTree Obj]->make_tree(string [component])  array
 - построение дерева с вершиной в элементе component;

 # [GenTree Obj]->save_json(string [component])  void
 - сохранение дерева с вершиной в элементе component;

 # [GenTree Obj]->show_branch(string [component], bool [all])  void
 - выводит дерево с вершиной в элементе component, all - рекурсивный вывод.
