/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package boxodering;

/**
 *
 * @author Todd Perry
 */
public class BoxOdering {

    /**
     * @param args the command line arguments
     */
    
    private static void moduleTestBox(){
        
        // MODULE TEST CODE
        
        //generates a box, 1m cubed, grade 1 card, sealable top
        // (6 * 0.45) * 1.05, priec >~ 3.00
        BoxI myBox = new BoxI(1, 1.0, 1.0, 1.0, true);
        double price = myBox.getPrice();
        double multiplier = myBox.getMultiplier();
        price = price * multiplier;
        System.out.println(price);
        
        BoxIV myBox2 = new BoxIV(1, 1.0, 1.0, 1.0,
                true, "red", "blue");
        price = myBox2.getPrice();
        double multiplier2 = myBox2.getMultiplier();
        price = price * multiplier2;
        System.out.println(price);
        
    }
    
    public static void main(String[] args) {
        //moduleTestBox(); //old price tests
        GUI.main(null);
    }
}
