{extends file='page.tpl'}

{block name='page_content_container'}
    <section id="content" class="page-home form-fields">
        <div class="configurator card">
        <form method="post">
            <aside id="notifications">

                {if $notifications.error}
                    {block name='notifications_error'}
                        <article class="notification notification-danger" role="alert" data-alert="danger">
                            <ul>
                                {foreach $notifications.error as $notif}
                                    <li>{$notif nofilter}</li>
                                {/foreach}
                            </ul>
                        </article>
                    {/block}
                {/if}

                {if $notifications.warning}
                    {block name='notifications_warning'}
                        <article class="notification notification-warning" role="alert" data-alert="warning">
                            <ul>
                                {foreach $notifications.warning as $notif}
                                    <li>{$notif nofilter}</li>
                                {/foreach}
                            </ul>
                        </article>
                    {/block}
                {/if}

                {if $notifications.success}
                    {block name='notifications_success'}
                        <article class="notification notification-success" role="alert" data-alert="success">
                            <ul>
                                {foreach $notifications.success as $notif}
                                    <li>{$notif nofilter}</li>
                                {/foreach}
                            </ul>
                        </article>
                    {/block}
                {/if}

                {if $notifications.info}
                    {block name='notifications_info'}
                        <article class="notification notification-info" role="alert" data-alert="info">
                            <ul>
                                {foreach $notifications.info as $notif}
                                    <li>{$notif nofilter}</li>
                                {/foreach}
                            </ul>
                        </article>
                    {/block}
                {/if}

            </aside>

            <div class="form-group">
                <h3>Rodzaj stolika stołu </h3>
                <div class="radio-wap">
                    <label><input type="radio" name="shape" value="stolik kawowy">Stolik kawowy</label>
                    <label><input type="radio" name="shape" value="stolik z plastra drewna">Stolik z plastra drewna</label>
                    <label><input type="radio" name="shape" value="stół do jadalni">Stół do jadalni</label>
                    <label><input class="showtextarea" type="radio" name="shape" value="inne">inne</label>
                </div>
                <textarea class="textarea-handle" name="shape-other"></textarea>
            </div>
            <div class="form-group">
                <h3>Rozmiar</h3>
                <div class="">
                    <textarea class="size" name="size"></textarea>
                    {*<div>
                        <h4>Wybierz długość swojego stołu</h4>
                        <div class="table-width">
                            <div id="table-width-handle" class="ui-slider-handle input-handler"></div>
                        </div>
                        <input id="table-width" type="hidden" name="table-width">
                    </div>
                    <div>
                        <h4>Wybierz szerokość swojego stołu</h4>
                        <div class="table-height">
                            <div id="table-height-handle" class="ui-slider-handle input-handler"></div>
                        </div>
                        <input id="table-height" type="hidden" name="table-height">
                    </div>*}
                </div>
            </div>
            <div class="form-group">
                <h3>Gatunek drewna </h3>
                <textarea name="type" ></textarea>
            </div>
            <div class="form-group">
                {*<h3>blat</h3>*}
                {*<h4>Wybierz grubość swojego stołu</h4>*}
                {*<div class="table-thick">*}
                    {*<div id="table-thick-handle" class="ui-slider-handle input-handler"></div>*}
                {*</div>*}
                {*<input id="table-thick" type="hidden" name="table-height">*}

                {*<h4>Wybierz krawędzie blatu</h4>*}

                {*<div class="radio-wap">*}
                    {*<label><input type="radio" name="cut" value="Proste">Proste</label>*}
                    {*<label><input type="radio" name="cut" value="Naturalne">Naturalne</label>*}
                    {*<label><input type="radio" name="cut" value="Scięte">Scięte</label>*}
                {*</div>*}
                <h3>Typ blatu</h3>
                {*<h4>Typ blatu</h4>*}
                <div class="radio-wap">
                    <label><input type="radio" name="blat" value="blat lity z naturalną krawędzią ">Blat lity z naturalną krawędzią </label>
                    <label><input type="radio" name="blat" value="blat klejony">Blat klejony</label>
                </div>
                    <label>Plaster drewna: </label>
                <div class="radio-wap">
                    <label><input type="radio" name="blat" value="blat z szkłem">Blat z szkłem </label>
                    <label><input type="radio" name="blat" value="blat z żywicą">Blat z żywicą</label>

                </div>
            </div>

            <div class="form-group">
                <h3>podstawa</h3>
                <div class="radio-wap">
                    <label><input type="radio" name="base" value="nogi stalowe">Nogi stalowe </label>
                    <label><input type="radio" name="base" value="nogi drewniane">Nogi drewniane</label>
                </div>
                <textarea name="base-other"></textarea>
            </div>
            <div class="form-group">
                <h4>e-mail</h4><br>
                <div>
                    <input type="email" name="email" required>
                </div>
            </div>
            <div class="form-group">
                <h4>numer telefonu</h4>
                <div>
                    <input type="telephone" name="telephone" required>
                </div>
            </div>
                       <div class="form-group">
                <h4>dodatkowe informacje</h4>
                <div>
                    <textarea name="text" ></textarea>
                </div>
            </div>
            <div class="form-group">

                <input type="hidden" name="csrf_token" value="{$csrf_token}">
                <button class="btn btn-primary" type="submit" name="saveForm">Wyślij zapytanie</button>
            </div>
        </form>
    </section>
    </div>
{/block}
