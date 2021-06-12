<tr>
    <td>{{$aff->id}}</td>
    <td><a href="{{ frontendRouter('affiliate', ['id' => $aff->id]) }}" style="color: black">{{$aff->username}}</a></td>
    <td><a href="{{ frontendRouter('affiliate', ['id' => $aff->id]) }}" style="color: black">{{$aff->email}}</a></td>
    <td>{{$aff->phone}}</td>
</tr>