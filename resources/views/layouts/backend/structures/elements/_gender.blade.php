@if($entity->isUserBoy())
    <span class="badge badge-danger">{{ getConfig('gender_alias.boy') }}</span>
@else
    <span class="badge badge-cyan">{{ getConfig('gender_alias.girl') }}</span>
@endif