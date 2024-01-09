import "styled-components"

declare module "styled-components" {
  export interface DefaultTheme {
    colors: {
      pink: string;
      darkPink: string;
      admin: string;
      darkAdmin: string;
      deliveryMan: string;
      darkDeliveryMan: string;
      customer: string;
      darkCustomer: string;
    };
  }
}