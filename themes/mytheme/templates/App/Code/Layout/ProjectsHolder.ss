<% include SideBar %>
<div class="content-container unit size3of4 lastUnit">
            		<article>
            			<h1>$Title</h1>
            			<div class="content">
            				$Content
            				<table>
            					<thead>
            						<tr>
            							<th>Projects</th>
            							<th>Students</th>
            							<th>Mentors</th>
            						</tr>
            					</thead>
            					<tbody>
            					<% loop $Children %>
            					    <tr>
            					        <td>
            					            <a href="$Link">$Title</a>
                                        </td>
                                        <td>
                                            <% loop $Students %>
                                                $Name ($University)<% if $Last !=1 %>,<% end_if %>
                                            <% end_loop %>
                                        </td>
                                        <td>
                                            <%loop $Mentors %>
                                                $Name<% if $Last !=1 %>,<% end_if %>
                                            <% end_loop %>
                                        </td>
                                    </tr>
                                <% end_loop %>
                                </tbody>
                            </table>
                        </div>
                    </article>
</div>



