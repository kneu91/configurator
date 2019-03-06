{extends file='page.tpl'}

{block name='page_content_container'}
    <section id="content" class="page-home">
        <form method="post">
            <input type="text" name="text">
            <button type="submit" name="saveForm">zapisz</button>
        </form>
    </section>
{/block}
