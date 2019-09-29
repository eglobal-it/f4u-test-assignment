import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {DashboardIndexPageComponent} from "./pages/dashboard/index.component";
import {ClientsIndexPageComponent} from "./pages/clients/index.component";
import {ClientsDetailPageComponent} from "./pages/clients/detail/detail.component";

const routes: Routes = [
  {path: '', component: DashboardIndexPageComponent},
  {path: 'clients', component: ClientsIndexPageComponent},
  {path: 'clients/:clientId', component: ClientsDetailPageComponent},
  {path: '**', redirectTo: '/'}
];

@NgModule({
  imports: [RouterModule.forRoot(routes, {enableTracing: true})],
  exports: [RouterModule]
})

export class AppRoutingModule {
}
