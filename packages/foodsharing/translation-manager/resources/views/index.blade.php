@extends((isset($package) ? $package . '::' : '') . 'layouts.master')

@section('content')
    <div class="col-sm-12 translation-manager">
        <div class="row">
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>@lang('translation-manager.translation-manager')</h1>
                        {{-- csrf_token() --}}
                        {{--{!! $userLocales !!}--}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p>@lang('translation-manager.export-warning-text') </p>
                        <div class="alert alert-danger alert-dismissible" style="display:none;">
                            <button type="button" class="close" data-hide="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="errors-alert">
                            </div>
                        </div>
                        <?= ifInPlaceEdit("@lang('translation-manager.import-all-done')") ?>
                        <div class="alert alert-success alert-dismissible" style="display:none;">
                            <button type="button" class="close" data-hide="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="success-import-all">
                                <p>@lang('translation-manager.import-all-done')</p>
                            </div>
                        </div>
                        <?= ifInPlaceEdit("@lang('translation-manager.import-group-done')", ['group' => $group]) ?>
                        <div class="alert alert-success alert-dismissible" style="display:none;">
                            <button type="button" class="close" data-hide="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="success-import-group">
                                <p>@lang('translation-manager.import-group-done', ['group' => $group]) </p>
                            </div>
                        </div>
                        <?= ifInPlaceEdit("@lang('translation-manager.search-done')") ?>
                        <div class="alert alert-success alert-dismissible" style="display:none;">
                            <button type="button" class="close" data-hide="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="success-find">
                                <p>@lang('translation-manager.search-done')</p>
                            </div>
                        </div>
                        <?= ifInPlaceEdit("@lang('translation-manager.done-publishing')", ['group' => $group]) ?>
                        <div class="alert alert-success alert-dismissible" style="display:none;">
                            <button type="button" class="close" data-hide="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="success-publish">
                                <p>@lang('translation-manager.done-publishing', ['group'=> $group])</p>
                            </div>
                        </div>
                        <?= ifInPlaceEdit("@lang('translation-manager.done-publishing-all')") ?>
                        <div class="alert alert-success alert-dismissible" style="display:none;">
                            <button type="button" class="close" data-hide="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="success-publish-all">
                                <p>@lang('translation-manager.done-publishing-all')</p>
                            </div>
                        </div>
                        <?php if(Session::has('successPublish')) : ?>
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-hide="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <?php echo Session::get('successPublish'); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        @if($adminEnabled)
                            <div class="row">
                                <div class="col-sm-12">
                                    <form id="form-import-all" class="form-import-all" method="POST"
                                            action="<?= action($controller . '@postImport', ['group' => '*']) ?>"
                                            data-remote="true" role="form">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <?= ifEditTrans('translation-manager.import-add') ?>
                                                <?= ifEditTrans('translation-manager.import-replace') ?>
                                                <?= ifEditTrans('translation-manager.import-fresh') ?>
                                                <div class="input-group-sm">
                                                    <select name="replace" class="import-select form-control">
                                                        <option value="0"><?= noEditTrans('translation-manager.import-add') ?></option>
                                                        <option value="1"><?= noEditTrans('translation-manager.import-replace') ?></option>
                                                        <option value="2"><?= noEditTrans('translation-manager.import-fresh') ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <?= ifEditTrans('translation-manager.import-groups') ?>
                                                <?= ifEditTrans('translation-manager.loading') ?>
                                                <button id="submit-import-all" type="submit" form="form-import-all"
                                                        class="btn btn-sm btn-success"
                                                        data-disable-with="<?= noEditTrans('translation-manager.loading') ?>">
                                                    <?= noEditTrans('translation-manager.import-groups') ?>
                                                </button>
                                                <?= ifEditTrans('translation-manager.zip-all') ?>
                                                <a href="<?= action($controller . '@getZippedTranslations', ['group' => '*']) ?>"
                                                        role="button" class="btn btn-primary btn-sm">
                                                    <?= noEditTrans('translation-manager.zip-all') ?>
                                                </a>
                                                <div class="input-group" style="float:right; display:inline">
                                                    <?= ifEditTrans('translation-manager.publish-all') ?>
                                                    <?= ifEditTrans('translation-manager.publishing') ?>
                                                    <button type="submit" form="form-publish-all"
                                                            class="btn btn-sm btn-warning input-control"
                                                            data-disable-with="<?= noEditTrans('translation-manager.publishing') ?>">
                                                        <?= noEditTrans('translation-manager.publish-all') ?>
                                                    </button>
                                                    <?= ifEditTrans('translation-manager.find-in-files') ?>
                                                    <?= ifEditTrans('translation-manager.searching') ?>
                                                    <button type="submit" form="form-find"
                                                            class="btn btn-sm btn-danger"
                                                            data-disable-with="<?= noEditTrans('translation-manager.searching') ?>">
                                                        <?= noEditTrans('translation-manager.find-in-files') ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?= ifEditTrans('translation-manager.confirm-find') ?>
                                    <form id="form-find" class="form-inline form-find" method="POST"
                                            action="<?= action($controller . '@postFind') ?>"
                                            data-remote="true" role="form"
                                            data-confirm="<?= noEditTrans('translation-manager.confirm-find') ?>">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div style="min-height: 10px"></div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <?= ifEditTrans('translation-manager.choose-group'); ?>
                                        <div class="input-group-sm">
                                            <?= Form::select('group', $groups, $group, array(
                                                'form' => 'form-select', 'class' => 'group-select form-control'
                                            )) ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <?php if ($adminEnabled): ?>
                                        <?php if ($group): ?>
                                        <?= ifEditTrans('translation-manager.publishing') ?>
                                        <?= ifEditTrans('translation-manager.publish') ?>
                                        <button type="submit" form="form-publish-group"
                                                class="btn btn-sm btn-info input-control"
                                                data-disable-with="<?= noEditTrans('translation-manager.publishing') ?>">
                                            <?= noEditTrans('translation-manager.publish') ?>
                                        </button>
                                        <?= ifEditTrans('translation-manager.zip-group') ?>
                                        <a href="<?= action($controller . '@getZippedTranslations', ['group' => $group]) ?>"
                                                role="button" class="btn btn-primary btn-sm">
                                            <?= noEditTrans('translation-manager.zip-group') ?>
                                        </a>
                                        <?= ifEditTrans('translation-manager.search'); ?>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#searchModal"><?= noEditTrans('translation-manager.search') ?></button>
                                        <?php endif; ?>
                                        <div class="input-group" style="float:right; display:inline">
                                            <?php if ($group): ?>
                                            <?= ifEditTrans('translation-manager.import-group') ?>
                                            <?= ifEditTrans('translation-manager.loading') ?>
                                            <button type="submit" form="form-import-group" class="btn btn-sm btn-success"
                                                    data-disable-with="<?= noEditTrans('translation-manager.loading') ?>">
                                                <?= noEditTrans('translation-manager.import-group') ?>
                                            </button>
                                            <?= ifEditTrans('translation-manager.delete') ?>
                                            <?= ifEditTrans('translation-manager.deleting') ?>
                                            <button type="submit" form="form-delete-group" class="btn btn-sm btn-danger"
                                                    data-disable-with="<?= noEditTrans('translation-manager.deleting') ?>">
                                                <?= noEditTrans('translation-manager.delete') ?>
                                            </button>
                                            <?php endif; ?>
                                        </div>
                                        <?php else: ?>
                                        <?php if ($group): ?>
                                        <?= ifEditTrans('translation-manager.search'); ?>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#searchModal"><?= noEditTrans('translation-manager.search') ?></button>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <?= ifEditTrans('translation-manager.confirm-delete') ?>
                                    <form id="form-delete-group" class="form-inline form-delete-group" method="POST"
                                            action="<?= action($controller . '@postDeleteAll', $group) ?>"
                                            data-remote="true" role="form"
                                            data-confirm="<?= noEditTrans('translation-manager.confirm-delete', ['group' => $group]) ?>">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    </form>
                                    <form id="form-import-group" class="form-inline form-import-group" method="POST"
                                            action="<?= action($controller . '@postImport', $group) ?>"
                                            data-remote="true" role="form">
                                        <input type="hidden" name="_token"
                                                value="<?php echo csrf_token(); ?>">
                                    </form>
                                    <form role="form" class="form" id="form-select"></form>
                                    <form id="form-publish-group" class="form-inline form-publish-group" method="POST"
                                            action="<?= action($controller . '@postPublish', $group) ?>"
                                            data-remote="true" role="form">
                                        <input type="hidden" name="_token"
                                                value="<?php echo csrf_token(); ?>">
                                    </form>
                                    <form id="form-publish-all" class="form-inline form-publish-all" method="POST"
                                            action="<?= action($controller . '@postPublish', '*') ?>"
                                            data-remote="true" role="form">
                                        <input type="hidden" name="_token"
                                                value="<?php echo csrf_token(); ?>">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div style="min-height: 10px"></div>
                        <div class="row">
                            <?php if(!$group): ?>
                            <div class="col-sm-10">
                                <p>@lang('translation-manager.choose-group-text')</p>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#searchModal" style="float:right; display:inline">
                                    <?= noEditTrans('translation-manager.search') ?>
                                </button>
                                <?= ifEditTrans('translation-manager.search') ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div style="min-height: 10px"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-12">
                        <div style="min-height: 10px"></div>
                        <form class="form-inline" id="form-interface-locale" method="GET"
                                action="<?= action($controller . '@getInterfaceLocale') ?>">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="row">
                                <div class=" col-sm-3">
                                    @if($adminEnabled && count($connection_list) > 1)
                                        <div class="input-group-sm">
                                            <label for="db-connection"><?= trans('translation-manager.db-connection') ?>:</label>
                                            <br>
                                            <select name="c" id="db-connection" class="form-control">
                                                @foreach($connection_list as $connection => $description)
                                                    <option value="<?=$connection?>"<?= $connection_name === $connection ? ' selected="selected"' : ''?>><?= $description ?></option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @else
                                        &nbsp;
                                    @endif
                                </div>
                                <div class=" col-sm-2">
                                    <div class="input-group-sm">
                                        <label for="interface-locale"><?= trans('translation-manager.interface-locale') ?>:</label>
                                        <br>
                                        <select name="l" id="interface-locale" class="form-control">
                                            @foreach($locales as $locale)
                                                <option value="<?=$locale?>"<?= $currentLocale === $locale ? ' selected="selected"' : ''?>><?= $locale ?></option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class=" col-sm-2">
                                    <div class="input-group-sm">
                                        <label for="translating-locale"><?= trans('translation-manager.translating-locale') ?>:</label>
                                        <br>
                                        <select name="t" id="translating-locale" class="form-control">
                                            @foreach($locales as $locale)
                                                @if($locale !== $primaryLocale)
                                                    <option value="<?=$locale?>"<?= $translatingLocale === $locale ? ' selected="selected"' : ''?>><?= $locale ?></option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class=" col-sm-2">
                                    <div class="input-group-sm">
                                        <label for="primary-locale"><?= trans('translation-manager.primary-locale') ?>:</label>
                                        <br>
                                        <select name="p" id="primary-locale" class="form-control">
                                            @foreach($locales as $locale)
                                                <option value="<?=$locale?>"<?= $primaryLocale === $locale ? ' selected="selected"' : ''?>><?= $locale ?></option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class=" col-sm-3">
                                    <?php if(str_contains($userLocales, ',' . $currentLocale . ',')): ?>
                                    <div class="input-group input-group-sm" style="float:right; display:inline">
                                        <?= ifEditTrans('translation-manager.in-place-edit') ?>
                                        <label for="edit-in-place">&nbsp;</label>
                                        <br>
                                        <a class="btn btn-sm btn-primary" role="button" id="edit-in-place" href="<?= action($controller . '@getToggleInPlaceEdit') ?>">
                                            <?= noEditTrans('translation-manager.in-place-edit') ?>
                                        </a>
                                    </div>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div style="min-height: 10px"></div>
                            <div class="row">
                                <div class=" col-sm-4">
                                    <div class="row">
                                        <div class=" col-sm-12">
                                            <?= formSubmit(trans('translation-manager.display-locales'), ['class' => "btn btn-sm btn-primary"]) ?>&nbsp;&nbsp;
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class=" col-sm-12">
                                            <div style="min-height: 10px"></div>
                                            <?= ifEditTrans('translation-manager.check-all') ?>
                                            <button id="display-locale-all"
                                                    class="btn btn-sm btn-default"><?= noEditTrans('translation-manager.check-all')?></button>
                                            <?= ifEditTrans('translation-manager.check-none') ?>
                                            <button id="display-locale-none"
                                                    class="btn btn-sm btn-default"><?= noEditTrans('translation-manager.check-none')?></button>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-sm-8">
                                    <div class="input-group-sm">
                                        @foreach($locales as $locale)
                                            <?php $isLocaleEnabled = str_contains($userLocales, ',' . $locale . ','); ?>
                                            <label>
                                                <input <?= $locale !== $primaryLocale && $locale !== $translatingLocale ? ' class="display-locale" ' : '' ?> name="d[]"
                                                        type="checkbox"
                                                        value="<?=$locale?>"
                                                <?= ($locale === $primaryLocale || $locale === $translatingLocale || array_key_exists($locale, $displayLocales)) ? 'checked' : '' ?>
                                                    <?= $locale === $primaryLocale ? ' disabled' : '' ?>><?= $locale ?>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if($usage_info_enabled)
                    <div class="row">
                        <div class="col-sm-12">
                            <div style="min-height: 10px"></div>
                            <form class="form-inline" id="form-usage-info" method="GET"
                                    action="<?= action($controller . '@getUsageInfo') ?>">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <input type="hidden" name="group" value="<?php echo $group ? $group : '*'; ?>">
                                <div class="row">
                                    <div class=" col-sm-12">
                                        <div class="row">
                                            <div class=" col-sm-4">
                                                <div class="row">
                                                    <div class=" col-sm-12">
                                                        <?= formSubmit(trans('translation-manager.set-usage-info'), ['class' => "btn btn-sm btn-primary"]) ?>&nbsp;&nbsp;
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-sm-8">
                                                <label>
                                                    <input id="show-usage-info" name="show-usage-info" type="checkbox" value="1" {!! $show_usage ? 'checked' : '' !!}>
                                                    {!! trans('translation-manager.show-usage-info') !!}
                                                </label>
                                                <label>
                                                    <input id="reset-usage-info" name="reset-usage-info" type="checkbox" value="1">
                                                    {!! trans('translation-manager.reset-usage-info') !!}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <br>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        @include($package . '::dashboard')
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        @if($mismatchEnabled && !empty($mismatches))
                            @include($package . '::mismatched')
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        @if($adminEnabled && $userLocalesEnabled && !$group)
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">@lang('translation-manager.user-admin')</h3>
                                </div>
                                <div class="panel-body">
                                    @include($package . '::user_locales')
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <?= ifEditTrans('translation-manager.enter-translation') ?>
        <?= ifEditTrans('translation-manager.missmatched-quotes') ?>
        <script>
            var MISSMATCHED_QUOTES_MESSAGE = "<?= noEditTrans(('translation-manager.missmatched-quotes'))?>";
        </script>
        <?php if($group): ?>
        <div class="row">
            <div class="col-sm-12 ">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @if($adminEnabled && $userLocalesEnabled)
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingUserAdmin">
                                <?= ifEditTrans('translation-manager.user-admin') ?>
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseUserAdmin"
                                            aria-expanded="false" aria-controls="collapseUserAdmin">
                                        <?= noEditTrans('translation-manager.user-admin') ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseUserAdmin" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="headingUserAdmin">
                                <div class="panel-body">
                                    <div class="col-sm-12">
                                        @include($package . '::user_locales')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($adminEnabled): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <?= ifEditTrans('translation-manager.suffixed-keyops') ?>
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                            aria-expanded="false" aria-controls="collapseOne">
                                        <?= noEditTrans('translation-manager.suffixed-keyops') ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <!-- Add Keys Form -->
                                    <div class="col-sm-12">
                                        <?=  Form::open(['id' => 'form-addkeys', 'method' => 'POST', 'action' => [$controller . '@postAdd', $group]]) ?>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="keys">@lang('translation-manager.keys'):</label><?= ifEditTrans('translation-manager.addkeys-placeholder') ?>
                                                <?=  Form::textarea('keys', Request::old('keys'), [
                                                    'class' => "form-control", 'rows' => "4", 'style' => "resize: vertical", 'placeholder' => noEditTrans('translation-manager.addkeys-placeholder')
                                                ]) ?>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="suffixes">@lang('translation-manager.suffixes'):</label><?= ifEditTrans('translation-manager.addsuffixes-placeholder') ?>
                                                <?=  Form::textarea('suffixes', Request::old('suffixes'), [
                                                    'class' => "form-control", 'rows' => "4", 'style' => "resize: vertical", 'placeholder' => noEditTrans('translation-manager.addsuffixes-placeholder')
                                                ]) ?>
                                            </div>
                                        </div>
                                        <div style="min-height: 10px"></div>
                                        <script>
                                            var currentGroup = '{{$group}}';
                                            function addStandardSuffixes(event) {
                                                event.preventDefault();
                                                $("#form-addkeys").first().find("textarea[name='suffixes']")[0].value = "-type\n-header\n-heading\n-description\n-footer" + (currentGroup === 'systemmessage-texts' ? '\n-footing' : '');
                                            }
                                            function clearSuffixes(event) {
                                                event.preventDefault();
                                                $("#form-addkeys").first().find("textarea[name='suffixes']")[0].value = "";
                                            }
                                            function clearKeys(event) {
                                                event.preventDefault();
                                                $("#form-addkeys").first().find("textarea[name='keys']")[0].value = "";
                                            }
                                            function postDeleteSuffixedKeys(event) {
                                                event.preventDefault();
                                                var elem = $("#form-addkeys").first();
                                                elem[0].action = "<?= action($controller . '@postDeleteSuffixedKeys', $group)?>";
                                                elem[0].submit();
                                            }
                                        </script>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <?= formSubmit(trans('translation-manager.addkeys'), ['class' => "btn btn-sm btn-primary"]) ?>
                                                <?= ifEditTrans('translation-manager.clearkeys') ?>
                                                <button class="btn btn-sm btn-primary"
                                                        onclick="clearKeys(event)"><?= noEditTrans('translation-manager.clearkeys') ?>
                                                </button>
                                                <div class="input-group" style="float:right; display:inline">
                                                    <?= ifEditTrans('translation-manager.deletekeys') ?>
                                                    <button class="btn btn-sm btn-danger"
                                                            onclick="postDeleteSuffixedKeys(event)">
                                                        <?= noEditTrans('translation-manager.deletekeys') ?>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <?= ifEditTrans('translation-manager.addsuffixes') ?>
                                                <button class="btn btn-sm btn-primary"
                                                        onclick="addStandardSuffixes(event)"><?= noEditTrans('translation-manager.addsuffixes') ?></button>
                                                <?= ifEditTrans('translation-manager.clearsuffixes') ?>
                                                <button class="btn btn-sm btn-primary"
                                                        onclick="clearSuffixes(event)"><?= noEditTrans('translation-manager.clearsuffixes') ?></button>
                                            </div>
                                            <div class="col-sm-2">
                                                <span style="float:right; display:inline">
                                                    <?= ifEditTrans('translation-manager.search'); ?>
                                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                            data-target="#searchModal"><?= noEditTrans('translation-manager.search') ?></button>
                                                </span>
                                            </div>
                                        </div>
                                        <?=  Form::close() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <?= ifEditTrans('translation-manager.wildcard-keyops') ?>
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                        <?= noEditTrans('translation-manager.wildcard-keyops') ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <div class="col-sm-12">
                                        <!-- Key Ops Form -->
                                        <div id="wildcard-keyops-results" class="results"></div>
                                        <?=  Form::open([
                                            'id' => 'form-keyops', 'data-remote' => "true", 'method' => 'POST', 'action' => [$controller . '@postPreviewKeys', $group]
                                        ]) ?>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="srckeys">@lang('translation-manager.srckeys'):</label><?= ifEditTrans('translation-manager.srckeys-placeholder') ?>
                                                <?=  Form::textarea('srckeys', Request::old('srckeys'), [
                                                    'id' => 'srckeys', 'class' => "form-control", 'rows' => "4", 'style' => "resize: vertical", 'placeholder' => noEditTrans('translation-manager.srckeys-placeholder')
                                                ]) ?>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="dstkeys">@lang('translation-manager.dstkeys'):</label><?= ifEditTrans('translation-manager.dstkeys-placeholder') ?>
                                                <?=  Form::textarea('dstkeys', Request::old('dstkeys'), [
                                                    'id' => 'dstkeys', 'class' => "form-control", 'rows' => "4", 'style' => "resize: vertical", 'placeholder' => noEditTrans('translation-manager.dstkeys-placeholder')
                                                ]) ?>
                                            </div>
                                        </div>
                                        <div style="min-height: 10px"></div>
                                        <script>
                                            var currentGroup = '{{$group}}';
                                            function clearDstKeys(event) {
                                                event.preventDefault();
                                                $("#form-keyops").first().find("textarea[name='dstkeys']")[0].value = "";
                                            }
                                            function clearSrcKeys(event) {
                                                event.preventDefault();
                                                $("#form-keyops").first().find("textarea[name='srckeys']")[0].value = "";
                                            }
                                            function postPreviewKeys(event) {
                                                //event.preventDefault();
                                                var elem = $("#form-keyops").first();
                                                elem[0].action = "<?= action($controller . '@postPreviewKeys', $group)?>";
                                                //elem[0].submit();
                                            }
                                            function postMoveKeys(event) {
                                                //event.preventDefault();
                                                var elem = $("#form-keyops").first();
                                                elem[0].action = "<?= action($controller . '@postMoveKeys', $group)?>";
                                                //elem[0].submit();
                                            }
                                            function postCopyKeys(event) {
                                                //event.preventDefault();
                                                var elem = $("#form-keyops").first();
                                                elem[0].action = "<?= action($controller . '@postCopyKeys', $group)?>";
                                                //elem[0].submit();
                                            }
                                            function postDeleteKeys(event) {
                                                //event.preventDefault();
                                                var elem = $("#form-keyops").first();
                                                elem[0].action = "<?= action($controller . '@postDeleteKeys', $group)?>";
                                                //elem[0].submit();
                                            }
                                        </script>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <?= ifEditTrans('translation-manager.clearsrckeys') ?>
                                                <button class="btn btn-sm btn-primary"
                                                        onclick="clearSrcKeys(event)"><?= noEditTrans('translation-manager.clearsrckeys') ?></button>
                                                <div class="input-group" style="float:right; display:inline">
                                                    <?= formSubmit(trans('translation-manager.preview'), [
                                                        'class' => "btn btn-sm btn-primary", 'onclick' => 'postPreviewKeys(event)'
                                                    ]) ?>
                                                    <?= ifEditTrans('translation-manager.copykeys'); ?>
                                                    <button class="btn btn-sm btn-primary" onclick="postCopyKeys(event)">
                                                        <?= noEditTrans('translation-manager.copykeys') ?>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <?= ifEditTrans('translation-manager.cleardstkeys') ?>
                                                <button class="btn btn-sm btn-primary"
                                                        onclick="clearDstKeys(event)"><?= noEditTrans('translation-manager.cleardstkeys') ?></button>
                                                <div class="input-group" style="float:right; display:inline">
                                                    <?= ifEditTrans('translation-manager.movekeys') ?>
                                                    <button class="btn btn-sm btn-warning" onclick="postMoveKeys(event)">
                                                        <?= noEditTrans('translation-manager.movekeys') ?>
                                                    </button>
                                                    <?= ifEditTrans('translation-manager.deletekeys') ?>
                                                    <button class="btn btn-sm btn-danger" onclick="postDeleteKeys(event)">
                                                        <?= noEditTrans('translation-manager.deletekeys') ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <?=  Form::close() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif ?>
                        @if($yandex_key)
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <?= ifEditTrans('translation-manager.translation-ops') ?>
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                                href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <?= noEditTrans('translation-manager.translation-ops') ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                                        aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                        <textarea id="primary-text" class="form-control" rows="3" name="keys"
                                                style="resize: vertical;" placeholder="<?= $primaryLocale ?>"></textarea>
                                                <div style="min-height: 10px"></div>
                                                <span></span> <span style="float:right; display:inline">
                                            <button id="translate-primary-current" type="button" class="btn btn-sm btn-primary">
                                                <?= $primaryLocale ?>&nbsp;<i class="glyphicon glyphicon-share-alt"></i>&nbsp;<?= $translatingLocale ?>
                                            </button>
                                        </span>
                                            </div>
                                            <div class="col-sm-6">
                                        <textarea id="current-text" class="form-control" rows="3" name="keys"
                                                style="resize: vertical;" placeholder="<?= $translatingLocale ?>"></textarea>
                                                <div style="min-height: 10px"></div>
                                                <button id="translate-current-primary" type="button" class="btn btn-sm btn-primary">
                                                    <?= $translatingLocale ?>&nbsp;<i class="glyphicon glyphicon-share-alt"></i>&nbsp;<?= $primaryLocale ?>
                                                </button>
                                                <span style="float:right; display:inline"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 ">
                <label for="show-matching-text" id="show-matching-text-label" class="regex-error">&nbsp;</label>
                <div class="form-inline">
                    <?= ifEditTrans('translation-manager.show-matching-text') ?>
                    <div class="input-group input-group-sm">
                        <input class="form-control" style="width: 200px;" id="show-matching-text" type="text" placeholder="{{noEditTrans('translation-manager.show-matching-text')}}">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" id="show-matching-clear" style="margin-right: 15px;">
                                &times;
                            </button>
                        </span>
                    </div>
                    <div class="input-group input-group-sm translation-filter">
                        {{--<label>@lang('translation-manager.show'):&nbsp;</label>--}}
                        <label class="radio-inline">
                            <input id="show-all" type="radio" name="show-options" value="show-all"> @lang('translation-manager.show-all')
                        </label>
                    </div>
                    <div class="input-group input-group-sm translation-filter">
                        <label class="radio-inline">
                            <input id="show-new" type="radio" name="show-options" value="show-new"> @lang('translation-manager.show-new')
                        </label>
                    </div>
                    <div class="input-group input-group-sm translation-filter">
                        <label class="radio-inline">
                            <input id="show-need-attention" type="radio" name="show-options" value="show-need-attention"> @lang('translation-manager.show-need-attention')
                        </label>
                    </div>
                    <div class="input-group input-group-sm translation-filter">
                        <label class="radio-inline">
                            <input id="show-nonempty" type="radio" name="show-options" value="show-nonempty"> @lang('translation-manager.show-nonempty')
                        </label>
                    </div>
                    <div class="input-group input-group-sm translation-filter">
                        <label class="radio-inline">
                            <input id="show-used" type="radio" name="show-options" value="show-used"> @lang('translation-manager.show-used')
                        </label>
                    </div>
                    <div class="input-group input-group-sm translation-filter">
                        <label class="radio-inline">
                            <input id="show-unpublished" type="radio" name="show-options" value="show-unpublished"> @lang('translation-manager.show-unpublished')
                        </label>
                    </div>
                    <div class="input-group input-group-sm translation-filter">
                        <label class="radio-inline">
                            <input id="show-empty" type="radio" name="show-options" value="show-empty"> @lang('translation-manager.show-empty')
                        </label>
                    </div>
                    <div class="input-group input-group-sm translation-filter">
                        <label class="radio-inline">
                            <input id="show-changed" type="radio" name="show-options" value="show-changed"> @lang('translation-manager.show-changed')
                        </label>
                    </div>
                    <div class="input-group input-group-sm translation-filter">
                        <label class="radio-inline">
                            <input id="show-deleted" type="radio" name="show-options" value="show-deleted"> @lang('translation-manager.show-deleted')
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 ">
                <div style="min-height: 10px"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 ">
                @include($package . '::translations-table')
            </div>
        </div>
    <?php endif; ?>
    <!-- Search Modal -->
        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="searchModalLabel">@lang('translation-manager.search-translations')</h4>
                    </div>
                    <div class="modal-body">
                        <form id="search-form" method="GET" action="<?= action($controller . '@getSearch') ?>" data-remote="true">
                            <div class="form-group">
                                <div class="input-group">
                                    <input id="search-form-text" type="search" name="q" class="form-control">
                                    <span class="input-group-btn">
                                        <?= formSubmit(trans('translation-manager.search'), ['class' => "btn btn-default"]) ?>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <div class="results"></div>
                    </div>
                    <div class="modal-footer">
                        <?= ifEditTrans('translation-manager.close') ?>
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><?= noEditTrans('translation-manager.close') ?></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- KeyOp Modal -->
        <div class="modal fade" id="keyOpModal" tabindex="-1" role="dialog" aria-labelledby="keyOpModalLabel"
                aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="keyOpModalLabel">@lang('translation-manager.keyop-header')</h4>
                    </div>
                    <div class="modal-body">
                        <div class="results"></div>
                    </div>
                    <div class="modal-footer">
                        <?= ifEditTrans('translation-manager.close') ?>
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><?= noEditTrans('translation-manager.close') ?></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Source Refs Modal -->
        <div class="modal fade" id="sourceRefsModal" tabindex="-1" role="dialog" aria-labelledby="keySourceRefsModal"
                aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="keySourceRefsModal">@lang('translation-manager.source-refs-header')
                                <code style="color:white">'<span id="key-name"></span>'</code></h4>
                    </div>
                    <div class="modal-body">
                        <div class="results"></div>
                    </div>
                    <div class="modal-footer">
                        <?= ifEditTrans('translation-manager.close') ?>
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><?= noEditTrans('translation-manager.close') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('body-bottom')
    <script>
        var URL_YANDEX_TRANSLATOR_KEY = '<?= action($controller . '@postYandexKey') ?>';
        var PRIMARY_LOCALE = '{{$primaryLocale}}';
        var CURRENT_LOCALE = '{{$currentLocale}}';
        var TRANSLATING_LOCALE = '{{$translatingLocale}}';
        var URL_TRANSLATOR_GROUP = '<?= action($controller . '@getView') ?>/';
        var URL_TRANSLATOR_ALL = '<?= action($controller . '@getIndex') ?>';
        var URL_TRANSLATOR_FILTERS = '<?= action($controller . '@getTransFilters') ?>';
        var CURRENT_GROUP = '<?= $group ?>';
        var MARKDOWN_KEY_SUFFIX = '<?= $markdownKeySuffix ?>';
    </script>

    <!-- Moved out to allow auto-format in PhpStorm w/o screwing up HTML format -->
    <script src="<?=  $public_prefix . $package ?>/js/xregexp-all.js"></script>
    <script src="<?=  $public_prefix . $package ?>/js/translations_page.js"></script>

    <?php
    $userLocaleList = [];
    foreach ($userList as $user) {
        if ($user->locales) {
            foreach (explode(",", $user->locales) as $userLocale) {
                $userLocale = trim($userLocale);
                if ($userLocale) $userLocaleList[$userLocale] = $userLocale;
            }
        }
    }

    foreach ($displayLocales as $userLocale) {
        $userLocaleList[$userLocale] = $userLocale;
    }

    natsort($userLocaleList);
    ?>

    <script>
        var TRANS_FILTERS = ({
            filter: "<?= isset($transFilters['filter']) ? $transFilters['filter'] : "" ?>",
            regex: "<?= isset($transFilters['regex']) ? $transFilters['regex'] : ""  ?>"
        });

        var USER_LOCALES = [
                <?php $addComma = false; ?>
                <?php foreach ($userLocaleList as $locale): ?>
                <?php if ($addComma) echo ","; else $addComma = true; ?> {
                value: '<?= $locale ?>', text: '<?= $locale ?>'
            }
            <?php endforeach; ?>
        ];
    </script>
@stop

