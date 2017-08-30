<table class="table table-condensed translation-stats">
    <thead>
        <tr>
            <th width="5%">@lang('translation-manager.user-id')</th>
            <th width="30%">@lang('translation-manager.user-email')</th>
            <th width="25%">@lang('translation-manager.user-name')</th>
            <th width="40%">@lang('translation-manager.user-locales')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($userList as $user)
            <tr>
                <td><?= $user->id ?: '&nbsp;'?></td>
                <td><?= $user->email ?: '&nbsp;'?></td>
                <td><?= isset($user->name) && $user->name ? $user->name : '&nbsp;'?></td>
                <td>
                    <a href="#" class="user-locales" data-type="checklist" data-pk="<?= $user->id ?>" data-url="<?= action($controller . '@postUserLocales') ?>" data-title="Select User Locales"
                            data-value="<?= $user->locales ?>"
                    ><?= $user->locales ?: '&nbsp;'?></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
