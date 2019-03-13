{extends file='page.tpl'}

{block name='page_content_container'}
    <section id="content" class="page-home form-fields">
        <form method="post">
            <div class="form-group">
                <label>e-mail</label><br>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>numer telefonu</label><br>
                <input type="telephone" name="telephone" required>
            </div>
                       <div class="form-group">
                <label>dodatkowe informacje</label><br>
                <textarea rows="4" cols="50" name="text" ></textarea>
            </div>
            <div class="form-group">

                <input type="hidden" name="csrf_token" value="{$csrf_token}">
                <button class="btn btn-primary" type="submit" name="saveForm">Wyślij zapytanie</button>
            </div>
        </form>
    </section>
{/block}
