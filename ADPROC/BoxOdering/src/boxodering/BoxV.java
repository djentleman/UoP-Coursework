/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package boxodering;

/**
 *
 * @author U AMD
 */
public class BoxV extends BoxIII {

    public BoxV() {
    } //default contructor
    
    public BoxV(int grade, double height, double width, double depth,
            boolean isSealable, String col1, String col2) {
        super(grade, height, width, depth, isSealable, col1, col2);
        id = 5;
    }
    

    
    public double getMultiplier(){ 
        //method is called from external processes, so public
        double multiplier = super.getMultiplier(17);//7 for reinforced sides, 10 for reinforced bottom
        multiplier = 1 + (multiplier / 100); //changes to percent form
        return multiplier;
    }
}
