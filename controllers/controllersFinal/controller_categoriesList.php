<?php

function getCategoriesToDisplay($category){
    return categoriesManager::getAllSubcategoriesFor($category);
}

?>