<table cellspacing="0" class="actions">
        <tbody><tr>
                    <td class="pager">
            {{$pages.link}}
            
            共{{$pages.total}}页            <span class="separator">|</span>
            每页<select onchange="loadByPagesize(this);" name="limit">{{html_options options=$sites.pagesize selected=$sites.currentps}}
								            </select>条      <span class="separator">|</span>      {{$pages.fromto}}
            <span class="separator">|</span>
            共有{{$pages.totalnum}}个记录 <span class="separator">|</span> 跳转 {{$pages.jump}}
                    </td>
                <td class="filter-actions a-right f-right">
                </td>
        </tr>
    </tbody></table>