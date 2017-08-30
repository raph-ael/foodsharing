<div class="box">
    <div class="box-header">
        <h3 class="box-title">@lang('translation-manager.stats')</h3>
        <div class="box-tools pull-right">
            <div class="pull-right mb-10 hidden-sm hidden-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal"
                        data-target="#searchModal"><?= trans('translation-manager.search') ?></button>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="box-body">
        <table class="table table-condensed translation-stats">
            <thead>
                <tr>
                    <th class="deleted" width="16%">@lang('translation-manager.deleted')</th>
                    <th class="missing" width="16%">@lang('translation-manager.missing')</th>
                    <th class="changed" width="16%">@lang('translation-manager.changed')</th>
                    <th class="cached" width="16%">@lang('translation-manager.cached')</th>
                    <th class="group" width="36%">@lang('translation-manager.group')</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stats as $stat)
                    <tr>
                        <td class="deleted"><?= $stat->deleted ?: '&nbsp;'?></td>
                        <td class="missing"><?= $stat->missing ?: '&nbsp;'?></td>
                        <td class="changed"><?= $stat->changed ?: '&nbsp;'?></td>
                        <td class="cached"><?= $stat->cached ?: '&nbsp;'?></td>
                        <?php
                        $action = action($controller . '@getView') . '/' . $stat->group;
                        ?>
                        @if ($stat->deleted)
                            <td class="group deleted">
                                <a href="<?=$action?>"><?= $stat->group ?: '&nbsp;'?></a>
                            </td>
                        @elseif ($stat->missing)
                            <td class="group missing">
                                <a href="<?=$action?>"><?= $stat->group ?: '&nbsp;'?></a>
                            </td>
                        @elseif ($stat->changed)
                            <td class="group changed">
                                <a href="<?=$action?>"><?= $stat->group ?: '&nbsp;'?></a>
                            </td>
                        @elseif ($stat->cached)
                            <td class="group cached">
                                <a href="<?=$action?>"><?= $stat->group ?: '&nbsp;'?></a>
                            </td>
                        @else
                            <td class="group">
                                <a href="<?=$action?>"><?= $stat->group ?: '&nbsp;'?></a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
