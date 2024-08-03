import { Application } from "stimulus";
import SearchController from "./search_controller";

const application = Application.start();
application.register("search", SearchController);
