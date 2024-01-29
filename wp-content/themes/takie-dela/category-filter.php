<form class="filter filter--category" action="<?php echo site_url('/'); ?>" method="get">
    <div class="filter__input-group">
        <div class="filter__input">
            <label for="date_filter" class="filter__label">Дата публикации</label>
            <div class="filter__datepicker">
            <input type="text" id="date_filter" name="date_filter" class="filter__date" placeholder="дд.мм.гггг" pattern="\d{2}\.\d{2}\.\d{4}" value="<?php echo isset($_GET['date_filter']) ? esc_attr($_GET['date_filter']) : ''; ?>">
            </div>
        </div>

        <div class="filter__input">
            <label for="category_filter" class="filter__label">Категория</label>
            <div class="filter__select-wrapper">
            <select name="category_filter" id="category_filter" class="filter__date">
                <option value="" <?php echo empty($_GET['category_filter']) ? 'selected' : ''; ?>> </option>
                <?php 
                $categories = get_categories();

                foreach ($categories as $category) {
                    if ($category->parent == 0) { 
                        $selected = (isset($_GET['category_filter']) && $_GET['category_filter'] == $category->term_id) ? 'selected' : '';
                        echo '<option value="' . $category->term_id . '" ' . $selected . '>' . $category->name . '</option>';
                    }
                }
                ?>
            </select>
            </div>
        </div>
    </div>
    <button type="submit" class="filter__button">Применить фильтры</button>
</form>
