<div>
<table>
<input type="hidden" name="domain" id="domains{{$log.id}}" value="{{$log.domain}}">
<input type="hidden" name="hid" id="hid{{$log.id}}" value="{{$log.id}}">
{{foreach from=$domainlist item=data}}
<tr>
<td>{{$data.domain}}</td>
<td>{{$data.host}}--{{$data.order}}</td>
<td><a href="javascript:void(0)" onclick="canceldomain('{{$data.domain}}',{{$data.id}})" >取消绑定</a></td>
</tr>
{{/foreach}}
<tr><td><input type="text" name="wdomain" id="wdomain{{$log.id}}">.{{$log.domain}}</td>
<td>
<select name="opendomain" id="opendomain{{$log.id}}">
               {{html_options options=$vpslist}}
             </select></td>
             <td><a href="javascript:void(0)" onclick="binding({{$log.id}})" >绑定</a></td>
             <tr>
</table>
</div>